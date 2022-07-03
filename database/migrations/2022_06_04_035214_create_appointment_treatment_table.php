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
        Schema::create('appointment_treatment', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->longText('observation');
            $table->foreignId('appointment_id')->constrained('appointments')
                ->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('treatment_id')->constrained('treatments')
                ->references('id')->onDelete('cascade')->onUpdate('cascade');
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
