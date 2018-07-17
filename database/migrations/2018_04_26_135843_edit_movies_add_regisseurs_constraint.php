<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMoviesAddRegisseursConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table){
            $table->unsignedInteger('regisseur_id');
            $table->foreign('regisseur_id')->references('id')->on('regisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table){
            $table->dropForeign('regisseur_id');
            $table->dropColumn('regisseur_id');
        });
    }
}
