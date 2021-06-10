<?php

namespace App\Notifications;

use App\Models\Trade;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

/**
 * Class ShortTradeOpenedNotification
 * @package App\Notifications
 */
class TradeOpenedNotification extends Notification
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
        $message = "*" . $this->trade->type_literally ."* trade opened:\n" .
            'Entry price:' . $this->trade->entry_price . "\n" .
            'Entry time:' . $this->trade->entry_time . "\n";

        return TelegramMessage::create()
            ->content($message)
            ->button('Open trading view', 'https://www.tradingview.com');
    }
}
