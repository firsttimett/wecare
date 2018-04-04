<?php

use Illuminate\Database\Seeder;

class UsersTableAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lim Tze Soon',
            'email' => 'tzesoon@hotmail.com',
            'password' => '$2y$10$ocsOKqlvRx7csctO7LLBreYMMnEgsotKGp8.P5sn1tez5WpySuEgm',
            'user_level' => '2',
            'active' => '1',
            'remember_token' => 'zyx1ykOFgbpdaMMreXqYtofxmZEozhyBS78kMYUhUlhO50VtPRjQJ0IF1cvm',
            'created_at' => '2018-03-01 01:43:45',
            'updated_at' => '2018-03-01 01:43:45'
        ]);
    }
}
