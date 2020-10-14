<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception_lines', function (Blueprint $table) {
            $table->id();
            $table->double('product_qty_command',20,2);
            $table->double('product_qty_shipped',20,2);
            $table->double('product_qty',20,2);
            $table->string('state')->default('brouillon');
            $table->string('type');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('reception_id')->nullable();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_unity_id')->nullable()->references('id')->on('product_unities')->constrained();
            $table->foreignId('warehouse_id')->constrained();
            $table->foreignId('type_move_id')->constrained();
            $table->foreignId('purchase_order_line_id')->nullable();
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
        Schema::dropIfExists('reception_lines');
    }
}
