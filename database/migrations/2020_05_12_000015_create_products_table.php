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
            $table->string('name');
            $table->string('ref');
            $table->double('sale_price',8,2);
            $table->double('alerte_stock',8,2);
            $table->double('optimal_stock',8,2);
            $table->double('physical_stock',8,2)->nullable();
            $table->double('virtual_stock',8,2)->nullable();
            $table->string('procurement_method');
            $table->double('standard_price',8,2);
            $table->double('cump',8,2)->nullable();
            $table->string('type');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('taxe_id')->nullable();
            $table->foreignId('warehouse_id')->nullable();
            $table->foreignId('category_product_id')->nullable();
            $table->foreignId('unity_id')->nullable()->references('id')->on('product_unities');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
    }
}
