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
        Schema::create('landing2_translations', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // hero, stats, who_we_are, why_us, etc.
            $table->string('field');   // title, description, badge, etc.
            $table->string('lang');    // ar, en
            $table->text('value')->nullable();
            $table->timestamps();
            
            $table->unique(['section', 'field', 'lang'], 'landing2_translations_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing2_translations');
    }
};
