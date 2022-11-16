<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionWillExpireEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $installment;
    private $project;
    private $user;

    public function __construct($installment, $user, $project)
    {
        $this->installment = $installment;
        $this->project = $project;
        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject($this->project->title .' project next installment last date on '.formatted_date($this->installment->next_installment))
            ->markdown('mail.send-subscription-will-expire-email', [
                'project' => $this->project,
                'user' => $this->user,
                'installment' => $this->installment,
            ]);
    }
}
