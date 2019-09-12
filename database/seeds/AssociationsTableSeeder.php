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
        $associations = factory( Association::class, 100 )->create();
    }
}
