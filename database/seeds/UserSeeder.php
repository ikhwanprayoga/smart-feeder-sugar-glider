<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@email.com', 'password' => bcrypt('123qwe')],
            ['name' => 'Jason', 'email' => 'jason@email.com', 'password' => bcrypt('123qwe')],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
