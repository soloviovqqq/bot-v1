<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

/**
 * Class SellNotification
 * @package App\Notifications
 */
class SellNotification extends Notification
{
    use Queueable;

    /**
     * @return array
     */
    public function via(): array
    {
        return [TelegramChannel::class];
    }

    /**
     * @return TelegramMessage
     */
    public function toTelegram(): TelegramMessage
    {
        $message = "Super trend *SELL* alert.\n" .
            "Alert time: " . Carbon::now() . "\n" .
            "Price: " . request()->input('price');

        return TelegramMessage::create()
            ->content($message)
            ->button('Open trading view', 'https://www.tradingview.com');
    }
}
