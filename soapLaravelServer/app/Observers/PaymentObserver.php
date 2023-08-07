<?php

namespace App\Observers;

use App\Models\PaymentM;
use App\Models\Client;
use App\Mail\PaymentNotification;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{

    public $afterCommit = true;

    /**
     * Handle the PaymentM "created" event.
     */
    public function created(PaymentM $paymentM): void
    {
        $client = Client::find($paymentM->client_id);
        Mail::to($client->email)->queue(new PaymentNotification($paymentM));
    }

    /**
     * Handle the PaymentM "updated" event.
     */
    public function updated(PaymentM $paymentM): void
    {
        //
    }

    /**
     * Handle the PaymentM "deleted" event.
     */
    public function deleted(PaymentM $paymentM): void
    {
        //
    }

    /**
     * Handle the PaymentM "restored" event.
     */
    public function restored(PaymentM $paymentM): void
    {
        //
    }

    /**
     * Handle the PaymentM "force deleted" event.
     */
    public function forceDeleted(PaymentM $paymentM): void
    {
        //
    }
}
