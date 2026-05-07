<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates a basic free plan assigned to theme-7 for all new vendors.
     */
    public function run(): void
    {
        // Only insert if no plans exist yet (avoid duplicates)
        if (DB::table('plans')->count() === 0) {
            DB::table('plans')->insert([
                'reorder_id'         => 1,
                'vendor_id'          => null,
                'name'               => 'الباقة الأساسية',
                'description'        => 'باقة مجانية تحتوي على الميزات الأساسية لتشغيل متجرك بشكل احترافي',
                'features'           => 'متجر إلكتروني احترافي|منتجات غير محدودة|لوحة تحكم متكاملة|دعم فني|ثيم عصري',
                'price'              => 0,
                'tax'                => null,
                'themes_id'          => '7',   // template-7 as default
                'plan_type'          => 1,
                'duration'           => 5,     // lifetime (no expiry)
                'days'               => 0,
                'order_limit'        => -1,    // unlimited orders
                'appointment_limit'  => -1,    // unlimited appointments
                'custom_domain'      => 2,
                'google_analytics'   => 2,
                'pos'                => 2,
                'vendor_app'         => 2,
                'customer_app'       => 2,
                'role_management'    => 2,
                'pwa'                => 2,
                'coupons'            => 1,
                'blogs'              => 1,
                'google_login'       => 2,
                'facebook_login'     => 2,
                'sound_notification' => 1,
                'whatsapp_message'   => 1,
                'telegram_message'   => 1,
                'pixel'              => 2,
                'is_available'       => 1,
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
