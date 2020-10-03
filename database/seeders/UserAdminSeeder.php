<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserAdminSeeder
 * @package Database\Seeders
 */
class UserAdminSeeder extends Seeder
{
    const ADMIN_NAME = "Administrator";
    const ADMIN_EMAIL = "admin@myexchangebot.com";
    const ADMIN_TEAM_NAME = "System Administrators";

    /**
     * @var Carbon
     */
    protected Carbon $insertDate;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDate();

        /** @var User $userAdmin */
        $userAdmin = DB::table('users')
            ->where('email', self::ADMIN_EMAIL)
            ->first(['id']);

        if (!empty($userAdmin)) {
            return;
        }

        $userAdminId = DB::table('users')->insertGetId([
            'name' => self::ADMIN_NAME,
            'email' => self::ADMIN_EMAIL,
            'email_verified_at' => $this->insertDate,
            'password' => Hash::make('password'),
            'created_at' => $this->insertDate,
            'updated_at' => $this->insertDate,
        ]);

        /** @var Team $teamAdmin */
        $teamAdmin = DB::table('teams')
            ->where('name', self::ADMIN_TEAM_NAME)
            ->where('user_id', $userAdminId)
            ->first();

        if (!empty($teamAdmin)) {
            return;
        }

        DB::table('teams')->insert([
            'user_id' => $userAdminId,
            'name' => self::ADMIN_TEAM_NAME,
            'personal_team' => false,
            'created_at' => $this->insertDate,
            'updated_at' => $this->insertDate,
        ]);
    }

    /**
     * @return void
     */
    protected function startDate(): void
    {
        $this->insertDate ??= now();
    }
}
