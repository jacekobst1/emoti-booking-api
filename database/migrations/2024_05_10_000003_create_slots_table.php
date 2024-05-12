<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignUuid('reservation_id')
                ->nullable()
                ->constrained('reservations')
                ->onDelete('cascade');
            $table->date('date');
            $table->integer('price');
            $table->timestamps();

            $table->unique(['asset_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
