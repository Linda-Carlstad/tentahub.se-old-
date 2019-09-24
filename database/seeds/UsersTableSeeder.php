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
           'name' => 'Linda Carlstad info',
           'email' => 'info@lindacarlstad.se',
           'password' => bcrypt('BytMigSnartLinda'),
           'association_id' => 1,
           'role' => 3,
           'email_verified_at' => now(),
           'created_at' => now(),
           'updated_at' => now(),
        ]);

        DB::table('users')->insert([
           'name' => 'Linda Carlstad utbildning',
            'email' => 'utbildning@lindacarlstad.se',
            'password' => bcrypt('BytMigSnartLinda'),
            'association_id' => 1,
            'role' => 3,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $users = factory( User::class, 100 )->create();
    }
}
