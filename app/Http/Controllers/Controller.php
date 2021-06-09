<?php

namespace App\Http\Controllers;

use App\Notifications\BuyNotification;
use App\Notifications\SellNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const CHAT_ID = -553452018;

    /**
     * @return JsonResponse
     */
    public function buy(): JsonResponse
    {
        Notification::route('telegram', self::CHAT_ID)
            ->notify(new BuyNotification);

        return response()->json();
    }

    /**
     * @return JsonResponse
     */
    public function sell(): JsonResponse
    {
        Notification::route('telegram', self::CHAT_ID)
            ->notify(new SellNotification);

        return response()->json();
    }
}
