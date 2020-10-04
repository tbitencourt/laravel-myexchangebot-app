<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

/**
 * Class BotManController
 * @package App\Http\Controllers
 */
class BotManController extends Controller
{

    /**
     * Place your BotMan logic here.
     * @return void
     */
    public function handle(): void
    {
        /** @var BotMan $botMan */
        $botMan = app('botman');

        $botMan->hears('{message}', function ($botMan, $message) {
            if ($message == 'hi') {
                $this->askName($botMan);
            } else {
                $botMan->reply("write 'hi' for testing...");
            }
        });

        $botMan->listen();
    }

    /**
     * Place your BotMan logic here.
     * @param BotMan $botMan
     * @return void
     */
    public function askName(BotMan $botMan): void
    {
        $botMan->ask('Hello! What is your Name?', function (Answer $answer) {
            $name = $answer->getText();
            /** @noinspection PhpUndefinedMethodInspection */
            $this->say('Nice to meet you ' . $name);
        });
    }
}
