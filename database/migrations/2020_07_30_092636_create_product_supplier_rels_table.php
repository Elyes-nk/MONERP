<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSupplierRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_supplier_rels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tier_id');
            $table->foreignId('product_id');
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->float('delai');
            $table->float('qtt_min');
            $table->float('price');
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
        Schema::dropIfExists('product_supplier_rels');
    }
}
