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
     * @param $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * @param $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->content('Super trend *SELL* alert. Alert time: ' . Carbon::now() . "\n" . json_encode(request()->toArray()))
            ->button('Open trading view', 'https://www.tradingview.com');
    }
}
