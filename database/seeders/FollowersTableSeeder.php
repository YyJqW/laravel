<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        $users=User::all();
        $user=$users->first();
        $user_id=$user->id;
        $fans=$users->slice(1);
        $fans_ids=$fans->pluck('id')->toArray();
        $user->follow($fans_ids);
        foreach ($fans as $fan)
        {
            $fan->follow($user_id);
        }
    }
}
