<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>  "admin",
            'email'     =>  'admin@gmail.com',
            'password'  =>  bcrypt('admin123')
        ]);

        DB::table('roles')->insert([
            'name'      =>  "admin"
        ]);

        $user = User::find(1);
        $user->roles()->attach(1);
    }
}
