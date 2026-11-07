<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizen_applications', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code', 36)->unique();
            $table->string('service_slug', 40);
            $table->text('applicant_name');
            $table->text('nik');
            $table->text('family_card_number');
            $table->text('birth_date');
            $table->text('phone');
            $table->text('address');
            $table->string('office');
            $table->date('visit_date');
            $table->string('time_slot', 20);
            $table->text('details');
            $table->json('documents');
            $table->string('status', 30)->default('submitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizen_applications');
    }
};
