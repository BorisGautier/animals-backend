<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->string("classe")->nullable();
            $table->string("order")->nullable();
            $table->string("family")->nullable();
            $table->date("date_naissance")->nullable();
            $table->string("sexe")->nullable();
            $table->string("localisation")->nullable();
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();
            $table->text("funfact")->nullable();
            $table->string("diet")->nullable();
            $table->text("habitat")->nullable();
            $table->text("menaces")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
