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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('title_en' )->nullable();
            $table->string('title_fa' )->nullable();
            $table->text('email_en' )->nullable();
            $table->text('email_fa' )->nullable();
            $table->string('sms_en' )->nullable();
            $table->string('sms_fa' )->nullable();
            $table->string('color' )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
