<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\ConnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('roles_screens_hotfields');
        Schema::create('role_screen_hotfields', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('workflow_id');
            $table->unsignedInteger('hotfield_id');
            $table->softDeletes();
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
        //
    }
};
