<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rp_break_downs', function (Blueprint $table) {
            $table->id();
            $table->double ('rate')->comment ('سعر العملة');
            $table->unsignedInteger ('currency_id');
            $table->unsignedInteger ('customer_id');
            $table->unsignedInteger ('opening_balance_id');
            $table->unsignedInteger ('document_id');
            $table->double ('debit')->nullable()->comment ('دَين');
            $table->double ('credit')->nullable()->comment ('مدين');
            $table->unsignedInteger('instalment_type_id');
            $table->json('terms')->nullable();
            $table->integer('repate')->nullable();
            $table->date('instalment_date');
            $table->double ('total');
            $table->longText('details')->nullable();
            $table->unsignedInteger('installment_statu_id')->nullable();
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
        Schema::dropIfExists('rp_break_downs');
    }
};
