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
        Schema::create('expedition_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('village_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->decimal('price_per_kg', 10, 2);
            $table->integer('min_weight');
            $table->string('estimated_delivery_time');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique([
                'province_id',
                'city_id',
                'district_id',
                'village_id'
            ], 'unique_expedition_location');

            $table->index([
                'province_id',
                'city_id',
                'district_id',
                'village_id',
                'is_active'
            ], 'expedition_lookup_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedition_prices');
    }
};
