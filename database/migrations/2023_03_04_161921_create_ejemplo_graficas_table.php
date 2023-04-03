<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ejemplo_graficas', function (Blueprint $table) {
            $table->id()->primaryKey();
            $table->integer('control');
            $table->integer('tempin');
            $table->integer('tempout');
            $table->integer('conductividad');
            $table->dateTime('datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejemplo_graficas');
    }
};
