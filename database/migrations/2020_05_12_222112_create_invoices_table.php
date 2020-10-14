<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->date('date');
            $table->date('date_due');
            $table->double('remise',20,2);
            $table->string('state')->default('brouillon');
            $table->double('ammount_ht',20,2);
            $table->double('ammount_tax',20,2);
            $table->double('ammount_total',20,2);
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('purchase_order_id')->constrained();
            $table->foreignId('reception_id');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('tier_id')->constrained();
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
        Schema::dropIfExists('invoices');
    }
}
