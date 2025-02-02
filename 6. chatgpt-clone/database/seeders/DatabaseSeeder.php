<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Chat::factory(100)
            ->create()
            ->each(function ($chat) {
                // For each chat, create 100 messages with the specific chat_id
                Message::factory(100)
                    ->create([
                        'chat_id' => $chat->id, // Pass the chat_id to associate the messages with the correct chat
                    ]);
            });
    }
}