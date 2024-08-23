<?php

namespace App\Exports;

use App\Notifications\ExportComplete;
use Illuminate\Support\Facades\Notification;

class NotifyUserOfCompletedExport
{
    public function handle()
    {
        // Notify the user or perform another action
        Notification::send(request()->user(), new ExportComplete('customers.csv'));
    }
}
