<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $isSent = true; 
        $status = $isSent ? 'sent' : 'received'; 
        $isSent = !$isSent; 
        $message = $isSent ? $this->faker->sentence : $this->faker->paragraph();
        return [
            'user_id' => 1,
            'status' => $status,
            'Message' => $message,
            'context' => json_encode([
                'role' => $isSent ? 'user' : 'model',
                'message' => $message,
            ]),
        ];
    }
}