<?php

use App\University;
use Illuminate\Database\Seeder;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->insert([
           'name' => 'Karlstad University',
           'nickname' => 'KAU',
           'city' => 'Karlstad',
           'created_at' => now(),
           'updated_at' => now(),
        ]);
        $university = factory( University::class, 100 )->create();
    }
}
