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
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('exporter_name')->nullable();
            $table->string('exporter_id')->nullable();
            $table->string('exporter_address')->nullable();
            $table->string('exporter_order')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('consignee_address')->nullable();
            $table->string('consignee_country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'exporter_name',
                'exporter_id',
                'exporter_address',
                'exporter_order',
                'consignee_name',
                'consignee_address',
                'consignee_country',
            ]);
        });
    }
};
