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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->unsignedBigInteger('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('passport')->nullable();
            $table->string('face')->nullable();
            $table->string('national_id')->nullable();
            $table->string('national_id2')->nullable();
            $table->string('gateway')->nullable();
            $table->string('invoiceReference')->nullable();
            $table->string('invoiceId')->nullable();
            $table->boolean('paid')->default(0);
            $table->float('price');
            $table->timestamp('paid_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
