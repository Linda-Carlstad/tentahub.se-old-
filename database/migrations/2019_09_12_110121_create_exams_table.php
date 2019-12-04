<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->date( 'date' );
            $table->string('file_name');
            $table->string('name');
            $table->string( 'path' );
            $table->bigInteger('views')->default( 0 );
            $table->bigInteger('downloads')->default( 0 );
            $table->decimal('rating')->nullable();
            $table->string('grade')->nullable();
            $table->decimal('points', 5, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
