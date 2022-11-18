<?php

namespace App\Mail;

use App\Models\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionExpiredEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Plan $plan;
    private $expireDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, $expireDate)
    {
        $this->plan = $plan;
        $this->expireDate = $expireDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->plan->name .' plan has been expired')
            ->markdown('mail.send-subscription-expired-email', [
                'plan' => $this->plan,
                'expireDate' => $this->expireDate
            ]);
    }
}
