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

            ],
            [
                'name' => 'Admin SCM',
                'email' => 'admin@gmail.com',
                'role' => 'staf_gudang',
                'password' => bcrypt('123')

            ]
        ];
        foreach ($userData as $val) {
            User::updateOrCreate(
                ['email' => $val['email']],
                $val
            );
        }
    }
}
