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
        Schema::create('appointment_treatments', function (Blueprint $table) {
            $table->double('price');
            $table->longText('observation');
            $table->foreignId('appointment_id')->constrained('appointments');
            $table->foreignId('treatment_id')->constrained('treatments');
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
        Schema::dropIfExists('appointment_treatments');
    }
};
