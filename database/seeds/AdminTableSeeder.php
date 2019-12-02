<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Mr.Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Mr.User',
            'email' => 'user@user.com',
            'password' => bcrypt('rootuser'),
        ]);
    }
}
