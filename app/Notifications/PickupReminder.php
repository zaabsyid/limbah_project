<?php

namespace App\Notifications;

use App\Models\PickUp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PickupReminder extends Notification
{
    public function __construct(public PickUp $pickup) {}

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Reminder: Penjemputan Limbah')
            ->line("Akan ada penjemputan limbah pada tanggal {$this->pickup->pickup_date->format('d-m-Y')}")
            ->line("Customer: {$this->pickup->customer->name}")
            ->line("Lokasi: {$this->pickup->customer->city->name}");
    }
}
