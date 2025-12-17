<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserCDL extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Cristian Leyton',
            'email' => 'clippyt@gmail.com',
            'password' => Hash::make('taringa1'),
            'profile_photo_path' => 'profile-photos/YhfNqi7moVGcBqrIzKDhq50sTttaDN6evD25dcRK.jpg'
        ]);
    }
}
