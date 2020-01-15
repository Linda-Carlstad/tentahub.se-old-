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
            $table->date( 'date' )->nullable();
            $table->string('file_name');
            $table->string('name');
            $table->string( 'path' );
            $table->string('type');
            $table->bigInteger('views')->default( 0 );
            $table->bigInteger('downloads')->default( 0 );
            $table->decimal('rating')->nullable();
            $table->string('grade')->nullable();
            $table->decimal('points', 5, 1)->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->ipAddress( 'created_from' );
            $table->ipAddress( 'changed_from' )->nullable();
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
