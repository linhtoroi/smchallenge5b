<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\STR;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'=>'admin',
            'isTeacher'=>'1',
            'password'=>bcrypt('admin'),
            'remember_token'=>STR::random(100),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);
        DB::table('users')->insert([
            'username'=>'18020758',
            'isTeacher'=>'0',
            'password'=>bcrypt('hihihi'),
            'remember_token'=>STR::random(100),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);
        DB::table('users')->insert([
            'username'=>'admin2',
            'isTeacher'=>'1',
            'password'=>bcrypt('hihihi'),
            'remember_token'=>STR::random(100),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        //
    }
}
