<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CurrencySeeder::class,
            GatewaySeeder::class,
            OptionSeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            MediaSeeder::class,
            MenuSeeder::class,
            TermSeeder::class,
            KycSeeder::class,
            PayoutMethodSeeder::class,
        ]);

        \Artisan::call('cache:clear');
    }
}
