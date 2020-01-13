<?php

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
        model::unguard();
         $this->call(UsersTableSeeder::class);
         $this->call(ProfileTableSeeder::class);
         model::reguard();
    
        }
}
