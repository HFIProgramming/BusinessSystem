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
        $zones = ['南方', '北方'];
        foreach ($zones as $zone) {
            $user = User::create([
                'name' => $zone,
                'email' => $zone . '@finance.club',
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
                'user_id' => $user->id,
                'name' => $zone
            ]);
        }
    }
}
