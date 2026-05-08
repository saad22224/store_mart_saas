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
            $table->integer('tax_report')->default(2)->after('pixel');
            $table->integer('global_addons')->default(2)->after('tax_report');
            $table->integer('product_qa')->default(2)->after('global_addons');
            $table->integer('bulk_import')->default(2)->after('product_qa');
            $table->integer('shipping_management')->default(2)->after('bulk_import');
            $table->integer('top_deals')->default(2)->after('shipping_management');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('tax_report')->default(2)->after('pixel');
            $table->integer('global_addons')->default(2)->after('tax_report');
            $table->integer('product_qa')->default(2)->after('global_addons');
            $table->integer('bulk_import')->default(2)->after('product_qa');
            $table->integer('shipping_management')->default(2)->after('bulk_import');
            $table->integer('top_deals')->default(2)->after('shipping_management');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['tax_report', 'global_addons', 'product_qa', 'bulk_import', 'shipping_management', 'top_deals']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['tax_report', 'global_addons', 'product_qa', 'bulk_import', 'shipping_management', 'top_deals']);
        });
    }
};
