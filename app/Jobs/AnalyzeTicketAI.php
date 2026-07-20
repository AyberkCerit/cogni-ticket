<?php

namespace App\Jobs;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AnalyzeTicketAI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;
    
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function handle(): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.3-70b-versatile',
            'response_format' => ['type' => 'json_object'], 
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "Sen profesyonel bir IT destek asistanısın. Görevin biletin aciliyetini belirlemek ve sorunu özetlemektir.
                    Çıktıyı SADECE JSON formatında vermelisin. Başka hiçbir metin veya markdown işareti kullanma.
                    
                    Format şu şekilde olmalı:
                    {
                        \"priority\": \"low, medium veya high seçeneklerinden biri\",
                        \"summary\": \"Sorunun en fazla 2-3 cümlelik net, anlaşılır Türkçe özeti\"
                    }"
                ],
                [
                    'role' => 'user',
                    'content' => "Bilet Konusu: " . $this->ticket->title . "\nDetay: " . $this->ticket->description
                ]
            ],
            'temperature' => 0.1, 
        ]);

        if ($response->successful()) {
            $aiResponse = json_decode($response->json('choices.0.message.content'), true);
            if (isset($aiResponse['priority']) && isset($aiResponse['summary'])) {
                $priority = strtolower(trim($aiResponse['priority']));
                
                $this->ticket->update([
                    'priority' => in_array($priority, ['low', 'medium', 'high']) ? $priority : 'low',
                    'ai_summary' => $aiResponse['summary'],
                    'is_ai_processed' => true,
                ]);

                Log::info("Bilet #{$this->ticket->id} AI tarafından analiz edildi ve özetlendi.");
            } else {
                Log::warning("Bilet #{$this->ticket->id} için AI geçersiz bir JSON formatı döndürdü.");
            }
        } else {
            Log::error('Groq API Hatası: ' . $response->body());
        }
    }
}