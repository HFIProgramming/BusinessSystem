<?php

use Illuminate\Database\Seeder;
use App\Zone;
use App\User;
use App\Resources;

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
                'name' => 'Zone' . $i,
                'email' => 'Zone' . $i . '@finance.club',
                'password' => bcrypt('zonezonezone'),
                'type' => 3
            ]);
            foreach (Resources::all() as $resource) {
                $user->resources()->create([
                    'resource_id' => $resource->id,
                    'user_id' => $user->id,
                    'amount' => 0,
                ]);
            }
            Zone::create([
                'user_id' => $user->id
            ]);
        }
    }
}
