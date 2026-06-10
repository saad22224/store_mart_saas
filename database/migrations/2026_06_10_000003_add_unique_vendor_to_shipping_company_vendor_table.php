<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            DELETE scv1 FROM shipping_company_vendor scv1
            INNER JOIN shipping_company_vendor scv2
                ON scv1.vendor_id = scv2.vendor_id
                AND scv1.id > scv2.id
        ");

        Schema::table('shipping_company_vendor', function (Blueprint $table) {
            $table->unique('vendor_id', 'shipping_company_vendor_vendor_unique');
        });
    }

    public function down(): void
    {
        Schema::table('shipping_company_vendor', function (Blueprint $table) {
            $table->dropUnique('shipping_company_vendor_vendor_unique');
        });
    }
};
