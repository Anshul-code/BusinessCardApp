<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>  'Anshul',
            'name_slug' => 'anshul',
            'email' => 'anshulkumar2027@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anshul@2027'), // password
            'address' => 'Shimla Himachal Pradesh , India',
            'dob' => '1999-03-06',
            'phone_number' => '7889564589',
            'role' => 'admin',
            'profile_image' => 'no_image.jpg',
            'remember_token' => Str::random(10),
        ]);
    }
}
