<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('appointment_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid('referred_by')->nullable()->constrained('midwives')->nullOnDelete();

            $table->date('referral_date');
            $table->string('hospital_name');
            $table->text('hospital_address')->nullable();
            $table->text('diagnosis');
            $table->text('reason');                                 // alasan rujukan
            $table->enum('referral_type', ['emergency', 'regular'])->default('regular');
            $table->enum('status', ['pending', 'sent', 'received'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
