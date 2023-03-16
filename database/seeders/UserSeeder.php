<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::factory()->create([
            'email' => 'user@user.com',
            'password' => Hash::make('rootadmin'),
            'username' => 'demo-user',
            'wallet' => 20000,
            'avatar' => 'https://avatars.dicebear.com/api/adventurer/avatar.png',
            'kyc_verified_at' => now(),
            'email_verified_at' => now(),
        ]);
    }
}
