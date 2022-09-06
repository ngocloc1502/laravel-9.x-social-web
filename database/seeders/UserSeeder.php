<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
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
        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        
        Schema::enableForeignKeyConstraints();
        \App\Models\User::insert([
            [
                'name' => 'Ngoc Loc',
                'email' => 'ngocloc1502@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'), // password
                'remember_token' => Str::random(10),
                'phonenumber' => '0374-677-990',
                'sex' => 0,
                'birthday' => '2002-12-18',
                'avatar' => 'avt_ngocloc.jpg',
            ],
        ]);

        \App\Models\User::factory(10)->create();
    }
}
