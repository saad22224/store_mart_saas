<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderShippingWhatsAppMessageBuilder;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class SendOrderToShippingCompanies
{
    public function __construct(
        private WhatsAppService $whatsAppService,
        private OrderShippingWhatsAppMessageBuilder $messageBuilder
    ) {
    }

    public function handle(OrderCreated $event): void
    {
        $order = $event->order->loadMissing(['details', 'vendor.shippingCompanies']);
        $shippingCompany = $order->vendor?->shippingCompanies()
            ->active()
            ->first();

        if (!$shippingCompany) {
            return;
        }

        $message = $this->messageBuilder->build($order);
        $response = $this->whatsAppService->sendMessage($shippingCompany->whatsapp_number, $message);

        Log::info('Shipping company WhatsApp notification sent', [
            'order_id' => $order->id,
            'shipping_company_id' => $shippingCompany->id,
            'success' => $response['success'] ?? false,
        ]);
    }
}
