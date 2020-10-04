<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ChatbotHintsSeeder
 * @package Database\Seeders
 */
class ChatbotHintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('chatbot_hints')->count() === 0) {
            DB::table('chatbot_hints')->insert([
                ['question' => 'HI||Hello||Hola', 'reply' => 'Hello, how are you.'],
                ['question' => 'How are you', 'reply' => 'Good to see you again!'],
                ['question' => 'what is your name||whats your name', 'reply' => 'My name is MyExchangeBot'],
                ['question' => 'what should I call you', 'reply' => 'You can call me MyExchangeBot'],
                ['question' => 'Where are you from?', 'reply' => 'I am from Brazil'],
                ['question' => 'Bye||See you later||Have a Good Day', 'reply' => 'Sad to see you are going. Have a nice day'],
            ]);
        }
    }
}
