<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->date("date2naissance");
            $table->string('photo')->unique()->nullable();
            $table->integer('contact1')->unique();
            $table->integer('contact2')->unique();
            $table->string("perfect_money")->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',["suse","st2or","master"])->defaul('suse');
            $table->boolean('is_locked')->default(true);
            $table->string("lien_parainage");

            $table->unsignedBigInteger("residence")->index("users_residence_id");

            $table->foreign('residence')
                  ->references('id')->on('residences')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');


            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
