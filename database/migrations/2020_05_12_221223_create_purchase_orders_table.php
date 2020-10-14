<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('condition_reglement')->nullable();
            $table->string('mode_reglement')->nullable();
            $table->date('date');
            $table->string('state')->default('brouillon');
            $table->date('date_shippement');
            $table->integer('delai')->nullable();
            $table->double('ammount_ht',20,2);
            $table->double('ammount_tax',20,2);
            $table->double('ammount_total',20,2);
            $table->double('remise',20,2)->nullable()->default(0);
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tier_id');
            $table->foreignId('list_price_id');
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
        Schema::dropIfExists('purchase_orders');
    }
}
