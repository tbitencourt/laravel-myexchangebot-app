<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserAdminSeeder::class,
            ChatbotHintsSeeder::class,
        ]);
//        ChatbotMessage::query()->insert([
//            ['message' => 'Hi', 'added_on' => now(), 'type_enum' => 2],
//            ['message' => 'Hello, how are you.', 'added_on' => now(), 'type_enum' => 1],
//            ['message' => 'what is your name', 'added_on' => now(), 'type_enum' => 2],
//            ['message' => 'My name is Exchange ChatBot', 'added_on' => now(), 'type_enum' => 1],
//        ]);
        // \App\Models\User::factory(10)->create();
    }
}
