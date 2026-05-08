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
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('reports')->default(2)->comment('1=enable, 2=disable');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('reports')->default(2)->comment('1=enable, 2=disable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('reports');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('reports');
        });
    }
};
