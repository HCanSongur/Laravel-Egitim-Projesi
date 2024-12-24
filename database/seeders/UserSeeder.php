<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
          'name' => 'Hasan',
          'email' => 'hasancansongur@outlook.com',
          'password' => bcrypt('12345678'),
          'role' => 'admin'
        ],
        [
           'name' => 'Can',
           'email' => 'hcansongur@outlook.com',
           'password' => bcrypt('12345678'),
           'role' => 'admin'
        ],   
       
        ]);

    }
}

