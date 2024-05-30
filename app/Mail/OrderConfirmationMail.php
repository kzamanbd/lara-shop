<?php

namespace App\Mail;

use App\Shipping;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Shipping
     */
    public $shipping;


    /**
     * OrderConfirmationMail constructor.
     * @param Shipping $product_shipping
     */
    public function __construct($shipping)
    {
        //
        $this->shipping = $shipping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation Email')->view('emails.order-confirmation', ['shipping' => $this->shipping]);
    }
}
