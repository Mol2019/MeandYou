<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user")->index("dons_user_id");
            $table->unsignedBigInteger("pack")->index("dons_pack_id");
            $table->enum("statut",["envoyé",'non envoyé',"fusionner à envoyer","Pas encore fusionner"])->default('Pas encore fusionner');
            $table->string("reference")->unique()->nullable();
            $table->date('date_envoie')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('pack')
                  ->references('id')->on('packs')
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
        Schema::dropIfExists('dons');
    }
}
