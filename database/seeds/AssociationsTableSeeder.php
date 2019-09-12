<?php

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
           'nickname' => 'Linda',
           'university_id' => 1,
           'created_at' => now(),
           'updated_at' => now(),
        ]);
        $associations = factory( Association::class, 100 )->create();
    }
}
