<?php

use Illuminate\Database\Seeder;
use App\Zone;
use App\User;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'name' => 'Zone'.$i,
                'email' => 'Zone'.$i.'@finance.club',
                'password' => bcrypt('zonezonezone'),
                'type' => 3
            ]);
            Zone::create([
                'user_id' => $user->id
            ]);
        }
    }
}
