<?php

namespace Database\Seeders;

use App\Models\Automation;
use Illuminate\Database\Seeder;

class AutomationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Automation::updateOrCreate(
            ['trigger_type' => 'after_registration'],
            [
                'name' => 'Encourage Adding Products',
                'delay_in_hours' => 1,
                'message' => 'مرحباً! لاحظنا أنك قمت بإضافة منتج واحد فقط حتى الآن. أضف المزيد من المنتجات لجذب المزيد من العملاء لمتجرك!',
                'is_active' => true,
            ]
        );

        Automation::updateOrCreate(
            ['trigger_type' => 'inactive_user'],
            [
                'name' => 'Inactive User Reminder',
                'delay_in_hours' => 24,
                'message' => 'اشتقنا لك! متجرك بانتظارك لتحقيق المزيد من المبيعات، سجل دخولك الآن ولا تفوت الفرصة.',
                'is_active' => true,
            ]
        );

        Automation::updateOrCreate(
            ['trigger_type' => 'store_created'],
            [
                'name' => 'Store Ready Notification',
                'delay_in_hours' => 0, // Event-based, immediately
                'message' => 'متجرك جاهز الآن! يمكنك البدء في استقبال الطلبات.',
                'is_active' => true,
            ]
        );

        Automation::updateOrCreate(
            ['trigger_type' => 'first_sale'],
            [
                'name' => 'First Sale Congratulation',
                'delay_in_hours' => 0, // Event-based, immediately
                'message' => 'ألف مبروك! لقد حققت أول عملية بيع في متجرك. نتمنى لك المزيد من التوفيق والنجاح.',
                'is_active' => true,
            ]
        );
    }
}
