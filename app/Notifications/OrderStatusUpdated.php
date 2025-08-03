<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Status Pesanan Anda Diperbarui')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Status pesanan Anda sekarang: *' . strtoupper($this->order->status) . '*')
            ->line('Invoice: ' . $this->order->invoice_number)
            ->action('Lihat Pesanan', url('/pesanan-saya'))
            ->line('Terima kasih telah berbelanja di Selaweave!');
    }
}
