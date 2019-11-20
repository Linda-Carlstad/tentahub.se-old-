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
            'country' => 'Sweden',
           'description' => 'En text om KAUs historia.',
            'url' => 'https://kau.se',
           'created_at' => now(),
           'updated_at' => now(),
        ]);
        $university = factory( University::class, 100 )->create();
    }
}
