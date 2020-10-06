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
                ['question' => 'help', 'reply' => $this->getHelpOptions()],
                ['question' => 'help exchange', 'reply' => $this->getHelpExchangeOption()],
                ['question' => 'help login', 'reply' => $this->getHelpLoginOption()],
                ['question' => 'HI||Hello||Hola', 'reply' => 'Hello, how are you.'],
                ['question' => 'How are you', 'reply' => 'Good to see you again!'],
                ['question' => 'what is your name||whats your name', 'reply' => 'My name is MyExchangeBot'],
                ['question' => 'what should I call you', 'reply' => 'You can call me MyExchangeBot'],
                ['question' => 'Where are you from?', 'reply' => 'I am from Brazil'],
                ['question' => 'Bye||See you later||Have a Good Day', 'reply' => 'Sad to see you are going. Have a nice day'],
            ]);
        }
    }

    /**
     * @return string
     */
    protected function getHelpOptions(): string
    {
        return 'I can perform some actions for you:'
            . '<br>- Currency Exchange (type: help exchange)'
            . '<br>- Login (type: help login)'
            . '<br>- Register (type: help register)'
            . '<br>- Deposit (type: help deposit)'
            . '<br>- Withdraw (type: help withdraw)'
            . '<br>- Balance (type: help balance)';
    }

    /**
     * @return string
     */
    protected function getHelpExchangeOption(): string
    {
        return 'To perform currency exchange of any amount of money,'
            . ' between two currencies, given their codes type this:'
            . '<br><i>&#92;&gt; @exchange &lt;currency_code_from&gt; &lt;currency_code_to&gt; &lt;value&gt;</i>';
    }

    /**
     * @return string
     */
    protected function getHelpLoginOption(): string
    {
        return 'To login with your account, please enter with your e-mail (minimum of 6 characters),'
            . ' given their codes type this:'
            . '<br><i>&#92;&gt; @login &lt;username&gt;</i>'
            . '<br>then it will ask you your password.
'           . '<br><i>&#92;&gt; &lt;password&gt;</i>';
    }
}
