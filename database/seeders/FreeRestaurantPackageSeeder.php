<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class FreeRestaurantPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PricingPlan::create([
            'name' => 'Free Restaurant Package',
            'description' => 'A specialized free plan for restaurants and cafés.',
            'price' => 0,
            'duration' => 1,
            'days' => 36500, // Effectively lifetime/very long duration
            'plan_type' => 1,
            'order_limit' => -1, // Unlimited
            'appointment_limit' => -1,
            'features' => '',
            'themes_id' => '16',
            'is_available' => 1,
            'custom_domain' => 2,
            'google_analytics' => 2,
            'vendor_app' => 2,
            'customer_app' => 2,
            'role_management' => 2,
            'pwa' => 2,
            'pos' => 2,
            'coupons' => 2,
            'blogs' => 2,
            'google_login' => 2,
            'facebook_login' => 2,
            'sound_notification' => 2,
            'whatsapp_message' => 2,
            'telegram_message' => 2,
        ]);
    }
}
