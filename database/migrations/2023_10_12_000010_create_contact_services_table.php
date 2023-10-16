<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('business_need', [
                'design_build',
                'furniture_only',
                'design_only',
            ]);
            $table->string('name');
            $table->unsignedInteger('phone_number');
            $table->string('email');
            $table->string('company_name');
            $table->string('location');
            $table->enum('luas', ['below_100m', '100m_200m', 'above_200m']);
            $table->enum('project_value', [
                '100_200_juta',
                '200_500_juta',
                '500_juta',
            ]);
            $table->text('info')->nullable();
            $table->dateTime('rencana_meeting');
            $table->dateTime('rencana_pembayaran');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_services');
    }
};
