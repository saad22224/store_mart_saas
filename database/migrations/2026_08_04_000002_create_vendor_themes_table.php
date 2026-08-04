<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('vendor_themes')) {
            Schema::create('vendor_themes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('image');
                $table->string('preview_link')->nullable();
                $table->integer('reorder_id')->default(0);
                $table->tinyInteger('is_active')->default(1);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_themes');
    }
};
