<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('genre_movie', function (Blueprint $table) {
            $table->unsignedInteger('genre_id');
            $table->unsignedInteger('movie_id');

            $table->primary(['genre_id', 'movie_id']);
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('movie_id')->references('id')->on('movies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('genre_movie', function (Blueprint $table){
            $table->dropForeign('movie_id');
            $table->dropForeign('genre_id');
        });

        Schema::dropIfExists('genres');
        Schema::dropIfExists('genre_movie');
    }
}
