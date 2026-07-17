<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all recent tickets (with user relationship)
        $recentTickets = \App\Models\Ticket::with('user')->latest()->take(5)->get();
        
        // Global stats
        $openTicketsCount = \App\Models\Ticket::where('status', 'pending')->count();
        $resolvedTodayCount = \App\Models\Ticket::where('status', 'resolved')->whereDate('updated_at', today())->count();
        
        $avgMinutes = (int) \App\Models\Ticket::where('status', 'resolved')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
            ->value('avg_time');
        
        $avgResponseHours = floor($avgMinutes / 60);
        $avgResponseMins = $avgMinutes % 60;
        
        // Bar Chart Data (Last 5 days)
        $last5Days = collect(range(4, 0))->map(fn($days) => today()->subDays($days));
        
        // 1. Created per day
        $createdPerDay = [];
        $maxCreated = 0;
        foreach($last5Days as $day) {
            $count = \App\Models\Ticket::whereDate('created_at', $day)->count();
            $createdPerDay[] = $count;
            $maxCreated = max($maxCreated, $count);
        }
        $createdHeights = array_map(fn($c) => $maxCreated > 0 ? max(5, round(($c / $maxCreated) * 100)) : 5, $createdPerDay);

        // 2. Resolved per day
        $resolvedPerDay = [];
        $maxResolved = 0;
        foreach($last5Days as $day) {
            $count = \App\Models\Ticket::whereIn('status', ['resolved', 'closed'])->whereDate('updated_at', $day)->count();
            $resolvedPerDay[] = $count;
            $maxResolved = max($maxResolved, $count);
        }
        $resolvedHeights = array_map(fn($c) => $maxResolved > 0 ? max(5, round(($c / $maxResolved) * 100)) : 5, $resolvedPerDay);

        // 3. Avg response time per day
        $avgTimePerDay = [];
        $maxAvgTime = 0;
        foreach($last5Days as $day) {
            $avgMins = (int) \App\Models\Ticket::whereIn('status', ['resolved', 'closed'])
                ->whereDate('updated_at', $day)
                ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
                ->value('avg_time');
                
            $avgTimePerDay[] = $avgMins;
            $maxAvgTime = max($maxAvgTime, $avgMins);
        }
        $avgTimeHeights = array_map(fn($c) => $maxAvgTime > 0 ? max(5, round(($c / $maxAvgTime) * 100)) : 5, $avgTimePerDay);

        // Get Weekly AI Summary (Token tasarrufu için haftalık önbellekleme)
        $cacheKey = 'dashboard_weekly_ai_summary';
        
        $aiSummary = \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addWeek(), function () {
            // Son 1 haftanın biletlerini al (Maksimum 50 bilet, token sınırını aşmamak için)
            $recentTickets = \App\Models\Ticket::where('created_at', '>=', now()->subWeek())
                                              ->latest()
                                              ->take(50)
                                              ->get();
            
            if ($recentTickets->isEmpty()) {
                return ['Sistemde bu hafta henüz bilet bulunmuyor.'];
            }

            $ticketsData = $recentTickets->map(function($ticket) {
                return "Konu: {$ticket->title}, Aciliyet: {$ticket->priority?->value}, Durum: {$ticket->status?->value}";
            })->implode("\n");

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'response_format' => ['type' => 'json_object'], 
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "Sen bir IT destek yöneticisi asistanısın.
                         Sana sistemdeki son 1 haftanın biletleri verilecek. 
                         Bu biletleri analiz et ve haftalık genel bir yönetici özeti çıkar. 
                         Hangi konulara yoğunlaşıldığını ve genel risk/aciliyet durumunu belirt. 
                         Çıktıyı SADECE JSON formatında vermelisin. Başka hiçbir metin veya markdown işareti kullanma.
                         \nFormat şu şekilde olmalı:\n{\n  \"bullets\": [\n    \"Haftanın risk ortalaması ve aciliyet durumu hakkında 1 cümlelik bilgi.\",\n    \"Hafta boyunca en çok yoğunlaşılan konular hakkında 1 cümlelik bilgi.\",\n    \"Dikkat çeken genel bir eğilim veya özet hakkında 1 cümlelik bilgi.\"\n  ]\n}
                         Tamamen Resmi ve Kurumsal bir dil kullan.\n
                         Cümlelerde Söylediğin şeyleri tekrarlamamaya dikkat et.
                         Örnek olarak: 'Ortalama Öncelik: high, Ortalama Durum: resolved, Weekly Activity: Yazılım ve Donanım sorunları öne çıktı.' gibi bir cümle kurabilirsin."
                    ],
                    [
                        'role' => 'user',
                        'content' => "Bu Haftanın Biletleri:\n" . $ticketsData
                    ]
                ],
                'temperature' => 0.3,
            ]);

            if ($response->successful()) {
                $data = json_decode($response->json('choices.0.message.content'), true);
                if (isset($data['bullets']) && is_array($data['bullets'])) {
                    return $data['bullets'];
                }
            }

            return [
                'Yapay zeka analizi şu an kullanılamıyor.',
                'Lütfen daha sonra tekrar deneyin.'
            ];
        });

        return view('dashboard', compact(
            'recentTickets', 'openTicketsCount', 'resolvedTodayCount', 'avgResponseHours', 'avgResponseMins',
            'createdHeights', 'resolvedHeights', 'avgTimeHeights', 'aiSummary'
        ));
    }
}