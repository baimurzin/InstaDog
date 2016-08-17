<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();
        $users = array(
            ['name' => 'Ryan Chenkie', 'email' => 'test1@mail.com', 'password' => Hash::make('secret')],
            ['name' => 'Chris Sevilleja', 'email' => 'test2@mail.com', 'password' => Hash::make('secret')],
            ['name' => 'Holly Lloyd', 'email' => 'test3@mail.com', 'password' => Hash::make('secret')],
            ['name' => 'Adnan Kukic', 'email' => 'test4@mail.com', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }
        Model::reguard();
    }
}
