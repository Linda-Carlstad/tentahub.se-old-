<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'email' => 'info@lindacarlstad.se',
           'password' => bcrypt('BytMigSnartLinda'),
           'association_id' => 1,
           'role' => '1',
           'created_at' => now(),
           'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'email' => 'utbildning@lindacarlstad.se',
            'password' => bcrypt('BytMigSnartLinda'),
            'association_id' => 1,
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
