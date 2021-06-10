<?php

namespace App\Notifications;

use App\Models\Trade;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

/**
 * Class TradeClosedNotification
 * @package App\Notifications
 */
class TradeClosedNotification extends Notification
{
    use Queueable;

    private Trade $trade;

    /**
     * TradeCloseNotification constructor.
     * @param Trade $trade
     */
    public function __construct(Trade $trade)
    {
        $this->trade = $trade;
    }

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
        $message = "Trade closed:\n" .
            'Entry price:' . $this->trade->entry_price . "\n" .
            'Entry time:' . $this->trade->entry_time . "\n" .
            'Exit price:' . $this->trade->exit_price . "\n" .
            'Exit time:' . $this->trade->exit_time . "\n" .
            'PLN:' . $this->trade->pln . "\n";

        return TelegramMessage::create()
            ->content($message);
    }
}
