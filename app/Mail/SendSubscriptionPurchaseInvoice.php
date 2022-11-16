<?php

namespace App\Mail;

use App\Models\PlanOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionPurchaseInvoice extends Mailable
{
    use Queueable, SerializesModels;

    private PlanOrder $order;
    private $total, $gatewayCharge;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PlanOrder $order)
    {
        $this->order = $order;
        $this->gatewayCharge = convert_money($order->gateway->charge, $order->gateway->currency);
        $this->total =  $this->order->amount + $this->gatewayCharge;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Invoice Payment Confirmation')
            ->markdown('mail.send-subscription-purchase-invoice', [
                'order' => $this->order,
                'gatewayCharge' => $this->gatewayCharge,
                'total' => $this->total
            ])
            ->attachFromStorageDisk('public', 'uploads/1/22/08/1661684648.mp3');
    }
}
