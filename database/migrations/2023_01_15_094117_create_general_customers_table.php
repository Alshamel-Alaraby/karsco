<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('name_e', 100);
            $table->string('phone', 50);
            $table->string('email', 100);
            $table->unsignedInteger('country_id')->nullable()->default(0);
            $table->unsignedInteger('city_id')->nullable()->default(0);
            $table->string('rp_code', 20)->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedInteger('bank_account_id');
            $table->string('contact_person', 100)->nullable();
            $table->string('contact_phone', 100)->nullable();
            $table->string('national_id', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('passport_no', 20)->nullable();
            $table->string('note1', 100)->nullable();
            $table->string('note2', 100)->nullable();
            $table->string('note3', 100)->nullable();
            $table->string('note4', 100)->nullable();

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
        Schema::dropIfExists('general_customers');
    }
};
