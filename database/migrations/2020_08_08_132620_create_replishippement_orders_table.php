<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplishippementOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replishippement_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->nullable();
            $table->foreignId('reception_line_id')->nullable();
            $table->foreignId('product_id');
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->foreignId('warehouse_id');
            $table->string("state");
            $table->float("product_qty");
            $table->date("date");
            $table->string("name");
            $table->string("message")->nullable();
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
        Schema::dropIfExists('replishippement_orders');
    }
}
