<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData =[
            [
                'name' => 'Staf Operasional',
                'email' => 'contohstaff12345@gmail.com',
                'role' => 'staf',
                'password' => bcrypt('123')

            ],
            [
                'name' => 'Staf IT',
                'email' => 'staff12345@gmail.com',
                'role' => 'staf',
                'password' => bcrypt('1234')

            ]
        ];
        foreach($userData as  $key => $val){
            User::create($val);
        }
    }
}
