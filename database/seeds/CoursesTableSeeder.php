<?php

use App\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'Anskaffning av it-system',
            'association_id' => 1,
            'code' => 'ISGA03',
            'points' => 12,
            'url' => null,
            'description' => null,
            'slug' => 'anskaffning-av-it-system'
        ]);
        $courses = factory( Course::class, 5 )->create();
    }
}
