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
            $table->id();
            $table->integer("category_id");
            $table->integer("section_id");
            $table->string("product_name");
            $table->string("product_code");
            $table->string("product_color");
            $table->float("product_price");
            $table->float("product_discount")->default(0);
            $table->float("product_weight")->nullable();
            $table->string("product_video")->nullable();
            $table->string("main_image")->nullable();
            $table->text("description");
            $table->string("wash_care")->nullable();
            $table->string("fabric")->nullable();
            $table->string("pattern")->nullable();
            $table->string("sleev")->nullable();
            $table->string("fit");
            $table->string("occasion")->nullable();
            // $table->string("url");
            $table->string("meta_title")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("meta_keywords")->nullable();
            $table->enum("is_featured", ['Yes', 'No']);
            $table->tinyInteger("status")->default(1);
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
