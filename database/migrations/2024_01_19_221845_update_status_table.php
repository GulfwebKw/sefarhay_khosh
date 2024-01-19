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
        Schema::table('status', function (Blueprint $table) {
            $table->string('description_en')->after('sms_fa')->nullable();
            $table->string('description_fa')->after('description_en')->nullable();
            $table->string('icon')->after('description_fa')->nullable();
            $table->boolean('is_active')->after('icon')->default(1);
            $table->integer('ordering')->after('is_active')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status', function (Blueprint $table) {
            $table->dropColumn('description_en','description_fa','icon' , 'is_active' ,'ordering');
        });
    }
};
