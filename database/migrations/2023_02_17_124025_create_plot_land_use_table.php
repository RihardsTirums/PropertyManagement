<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plot_land_uses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plot_id');
            $table->unsignedBigInteger('land_use_id');
            $table->foreign('plot_id')->references('id')->on('plots')->onDelete('cascade');
            $table->foreign('land_use_id')->references('id')->on('land_uses')->onDelete('cascade');
            $table->unique(['plot_id', 'land_use_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_land_uses');
    }
};
