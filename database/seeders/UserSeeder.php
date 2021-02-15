<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            [
                'name' =>  "Anshul Kumar",
                'name_slug' => 'anshul-kumar',
                'email' => 'anshulkumar2028@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Anshul@2028'), // password
                'address' => 'Shimla Himachal Pradesh , India',
                'dob' => '1999-03-06',
                'phone_number' => '7889564589',
                'role' => 'user',
                'profile_image' => 'no_image.jpg',
                'remember_token' => Str::random(10),
            ],
            [
                'name' =>  'Akshay Kumar',
                'name_slug' => 'akshay-kumar',
                'email' => 'akshaykumar2028@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Akshay@2028'), // password
                'address' => 'Shimla Himachal Pradesh , India',
                'dob' => '2001-12-28',
                'phone_number' => '7089864589',
                'role' => 'user',
                'profile_image' => 'no_image.jpg',
                'remember_token' => Str::random(10),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
        
    }
}
