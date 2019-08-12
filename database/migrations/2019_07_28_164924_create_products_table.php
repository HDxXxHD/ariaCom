<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('comment_id')->unsigned()->nullable();
            $table->string('pro_title')->nullable();
            $table->text('pro_desc')->nullable();
            $table->string('pro_brand')->nullable();
            $table->string('pro_origin')->nullable();
            $table->string('pro_type')->nullable();
            $table->string('pro_model')->nullable();
            $table->text('pro_packing')->nullable();
            $table->text('pro_termsSale')->nullable();
            $table->string('pro_incoterms')->nullable();
            $table->text('pro_payType')->nullable();
            $table->string('pro_color')->nullable();
            $table->string('pro_photo' , 255)->default('noproduct.png')->nullable();
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
        Schema::dropIfExists('products');
    }
}
