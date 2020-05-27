<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            

            $table->integer("store_id");

            $table->string("title");
            $table->string("type");
            $table->string("vendor");
            $table->longText("description");
            $table->string("location");
            $table->boolean("available")->nullable();
            $table->double("price");
            $table->string("currency");
            $table->boolean("featured")->default(false);




            //farm
            $table->integer("quantity")->nullable();
            $table->longtext("tags")->nullable();
            $table->double("weight")->nullable();
            $table->string("unit")->nullable();

            //vehicle
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('transmission')->nullable();
            $table->longText('features')->nullable();

            //clothing
            $table->string("brand")->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
