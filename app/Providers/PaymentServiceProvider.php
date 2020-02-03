<?php

namespace App\Providers;

use App\Services\Payment;
use Illuminate\Support\ServiceProvider;


class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Payment', Payment::class);
    }

}