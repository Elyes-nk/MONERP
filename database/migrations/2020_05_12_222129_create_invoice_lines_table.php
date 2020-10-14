<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->double('product_qty',20,2);
            $table->double('price_unit',20,2);
            $table->double('amount',20,2);
            $table->double('remise',20,2);
            $table->string('state')->default('brouillon');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_unity_id')->nullable()->references('id')->on('product_unities')->constrained();
            $table->foreignId('invoice_id');
            $table->foreignId('purchase_order_line_id')->constrained();
            $table->foreignId('reception_line_id')->nullable()->constrained();
            $table->foreignId('taxe_id')->nullable()->constrained();
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
        Schema::dropIfExists('invoice_lines');
    }
}
