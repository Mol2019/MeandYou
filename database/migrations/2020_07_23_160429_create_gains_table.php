<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("master")->index('gains_master_id');
            $table->unsignedBigInteger("don")->index('gains_don_id');
            $table->double("montant");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("master")
                  ->references("id")->on("users")
                  ->onUpdate("cascade")
                  ->onDelete("cascade");

            $table->foreign("don")
                  ->references("id")->on("dons")
                  ->onUpdate("cascade")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gains');
    }
}
