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
                ['question' => 'help', 'reply' => 'I can perform some actions for you:<br>- Currency Exchange (type: help exchange)'],
                ['question' => 'help exchange', 'reply' => 'To perform currency exchange of any amount of money, between two currencies, given their codes type this:<br>@exchange &lt;currency_code_from&gt; &lt;currency_code_to&gt; &lt;value&gt;'],
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
