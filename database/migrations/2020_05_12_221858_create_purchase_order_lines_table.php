<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->id();
            $table->double('product_qty',20,2);
            $table->double('price_unit',20,2);
            $table->double('amount',20,2);
            $table->double('remise',20,2)->nullable();
            $table->string('state')->default('brouillon');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id');
            $table->foreignId('unity_id')->nullable()->references('id')->on('product_unities');
            $table->foreignId('purchase_order_id');
            $table->foreignId('warehouse_id');
            $table->foreignId('taxe_id')->nullable();
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
        Schema::dropIfExists('purchase_order_lines');
    }
}
