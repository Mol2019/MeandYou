<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRsdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsds', function (Blueprint $table) {
            $table->id();
            $table->enum("statut",["none","partial","full"])->default("none");
            $table->date("date_reception")->nullable();
            $table->double("montant");
            $table->unsignedBigInteger('don')->index('rsds_don_id');
            $table->unsignedBigInteger('user')->index('rsds_user_id');
            $table->string('references')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('don')
                  ->references('id')->on('dons')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('user')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rsds');
    }
}
