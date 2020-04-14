<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("name")->unique();
            $table->string("owner");
            $table->longText("tags")->nullable();
            $table->string("email");
            $table->string("password")->nullable();
            $table->longText("description");
            $table->string("logo")->nullable();
            $table->string("header")->nullable();
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
        Schema::dropIfExists('stores');
    }
}
