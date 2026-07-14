<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TicketCategory;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\ActivityLogs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('tr_TR');

        // 1. Kullanıcılar
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $agent = User::create([
            'name' => 'Support Agent',
            'email' => 'agent@example.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
        ]);

        $customer = User::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $users = [$admin, $agent, $customer];

        // Ekstra rastgele müşteriler
        for ($i = 0; $i < 5; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]);
        }

        // 2. Kategoriler
        $categories = [
            'Teknik Destek' => 'Sistemdeki teknik hatalar ve sorunlar.',
            'Fatura / Ödeme' => 'Ödeme, iade ve fatura işlemleri.',
            'Genel Bilgi' => 'Genel sorular ve bilgilendirmeler.',
            'Öneri / Şikayet' => 'Geri bildirimler ve öneriler.',
        ];

        $categoryModels = [];
        foreach ($categories as $name => $desc) {
            $categoryModels[] = TicketCategory::create([
                'name' => $name,
                'description' => $desc,
            ]);
        }

        // 3. Biletler (Tickets)
        $statuses = ['active', 'pending', 'resolved', 'closed'];
        $priorities = ['low', 'medium', 'high', 'urgent'];

        $tickets = [];
        for ($i = 0; $i < 15; $i++) {
            $randomCustomer = $users[array_rand($users)];
            $randomCategory = $categoryModels[array_rand($categoryModels)];
            
            $ticket = Ticket::create([
                'user_id' => $randomCustomer->id,
                'title' => $faker->sentence(4),
                'description' => $faker->paragraph(3),
                'status' => $statuses[array_rand($statuses)],
                'category_id' => $randomCategory->id,
                'priority' => $priorities[array_rand($priorities)],
                'ai_summary' => $faker->boolean(50) ? $faker->sentence(6) : null,
                'is_ai_processed' => $faker->boolean(50),
            ]);
            $tickets[] = $ticket;
        }

        // 4. Bilet Mesajları ve Loglar
        foreach ($tickets as $ticket) {
            // Her bilete rastgele 1-4 arası mesaj
            $messageCount = rand(1, 4);
            for ($m = 0; $m < $messageCount; $m++) {
                // Mesajı atan ya bileti açan kişi ya da agent olsun
                $sender = rand(0, 1) ? $ticket->user : $agent;
                
                TicketMessage::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $sender->id,
                    'message' => $faker->paragraph(1),
                ]);
            }

            // Her bilet için 1-2 activity log
            $logCount = rand(1, 2);
            for ($l = 0; $l < $logCount; $l++) {
                ActivityLogs::create([
                    'user_id' => $ticket->user_id,
                    'ticket_id' => $ticket->id,
                    'action' => 'ticket_created',
                    'old_value' => null,
                    'new_value' => 'Ticket created successfully',
                ]);
            }
        }
    }
}
