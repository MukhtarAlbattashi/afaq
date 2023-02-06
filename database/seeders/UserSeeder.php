<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', 'admin@admin.com')->exists()) {
            $user = User::where('email', 'admin@admin.com')->first();
            $this->createUser($user);
        } else {
            $user = new User();
            $this->createUser($user);
        }
        if (App::environment(['local'])) {
            User::factory()
                ->count(10)
                ->hasOrders(1, [])
                ->hasGames(2, [])
                ->create();
        }

    }

    /**
     * @param User $user
     * @return void
     */
    public function createUser(User $user): void
    {
        $user->name = 'Mukhtar';
        $user->email = 'admin@admin.com';
        $user->role = 'admin';
        $user->password = Hash::make('password');
        $user->email_verified_at = now();
        $user->dailycoins = now();
        $user->coins = 1000;
        $user->save();
    }
}
