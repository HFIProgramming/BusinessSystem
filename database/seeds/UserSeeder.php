<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'root',
            'email' => 'root@finance.club',
            'password' => bcrypt('rootroot'),
            'type' => 0
        ]);
    }
}
