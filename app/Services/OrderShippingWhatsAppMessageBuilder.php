<?php

namespace App\Services;

use App\Helpers\helper;
use App\Models\Order;

class OrderShippingWhatsAppMessageBuilder
{
    public function build(Order $order): string
    {
        $order->loadMissing(['details', 'vendor']);

        $products = $order->details->map(function ($detail) use ($order) {
            $price = (float) $detail->price + (float) $detail->variants_price;

            return sprintf(
                '- %s x %s | السعر: %s',
                $detail->item_name,
                $detail->qty,
                helper::currency_formate($price, $order->vendor_id)
            );
        })->implode("\n");

        $addressParts = array_filter([
            $order->delivery_area,
            $order->address,
            $order->building,
            $order->landmark,
            $order->pincode,
        ]);

        $paymentMethod = helper::getpayment($order->payment_type, $order->vendor_id)->payment_name ?? $order->payment_type;
        $storeName = helper::appdata($order->vendor_id)->website_title ?? $order->vendor?->name ?? '';

        return trim(
            "طلب شحن جديد\n\n" .
            "رقم الطلب: #{$order->order_number}\n\n" .
            "بيانات العميل:\n" .
            "الاسم: {$order->customer_name}\n" .
            "الهاتف: {$order->mobile}\n" .
            "العنوان: " . implode(' - ', $addressParts) . "\n" .
            "المحافظة والمدينة: {$order->delivery_area}\n\n" .
            // "المنتجات:\n{$products}\n\n" .
            "إجمالي الطلب: " . helper::currency_formate($order->grand_total, $order->vendor_id) . "\n" .
            "طريقة الدفع: {$paymentMethod}\n" .
            "تاريخ الطلب: {$order->created_at->format('Y-m-d H:i')}\n\n" .
            "بيانات التاجر:\n" .
            "اسم المتجر: {$storeName}\n" .
            "اسم التاجر: " . ($order->vendor?->name ?? '') . "\n" .
            "هاتف التاجر: " . ($order->vendor?->mobile ?? '') . "\n\n" .
            "يرجى التواصل مع العميل واستلام الطلب للشحن."
        );
    }
}
