<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_content_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('item_id');
            $table->string('section_type', 64);
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->json('media')->nullable();
            $table->json('meta')->nullable();
            $table->integer('reorder_id')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();

            $table->index(['vendor_id', 'item_id']);
            $table->index(['item_id', 'is_active', 'reorder_id']);
            $table->index('section_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_content_sections');
    }
};
