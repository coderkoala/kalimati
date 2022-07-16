<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

class DispatchDailyPrices extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $daily_prices;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->daily_prices = $data;

        $this->message = (new MailMessage)->subject(__('email.i18n_subject'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.daily_prices')->with(
            array_merge(['daily_prices' => $this->daily_prices, 'url'=>env('APP_URL') ], $this->message->data()));
    }
}
