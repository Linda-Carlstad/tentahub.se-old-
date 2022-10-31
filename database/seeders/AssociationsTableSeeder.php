<?php

namespace Database\Seeders;

use App\Association;
use Illuminate\Database\Seeder;

class AssociationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('associations')->insert([
           'name' => 'Linda Carlstad',
           'url' => 'https://lindacarlstad.se',
           'university_id' => 1,
           'description' => 'Linjeförening för datavetare',
           'created_at' => now(),
           'updated_at' => now(),
           'slug' => 'linda-carlstad'
        ]);
        $associations = factory( Association::class, 5 )->create();
    }
}
