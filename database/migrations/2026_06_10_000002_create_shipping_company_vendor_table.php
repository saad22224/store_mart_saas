<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('shipping_company_vendor');

        $userIdColumn = DB::selectOne("SHOW COLUMNS FROM users WHERE Field = 'id'");
        $vendorIdColumnMethod = str_contains(strtolower($userIdColumn->Type ?? ''), 'bigint')
            ? 'unsignedBigInteger'
            : 'unsignedInteger';

        Schema::create('shipping_company_vendor', function (Blueprint $table) use ($vendorIdColumnMethod) {
            $table->id();
            $table->foreignId('shipping_company_id')->constrained('shipping_companies')->cascadeOnDelete();
            $table->{$vendorIdColumnMethod}('vendor_id');
            $table->timestamps();

            $table->unique(['shipping_company_id', 'vendor_id'], 'shipping_company_vendor_unique');
        });

        Schema::table('shipping_company_vendor', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_company_vendor');
    }
};
