<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(50)->create();
        $user=User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->is_admin=true;
        $user->save();
    }
}
