<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Notifications\TradeOpenedNotification;
use App\Notifications\TradeClosedNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Utils\TradeService\TradeService;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const CHAT_ID = -553452018;

    private TradeService $tradeService;

    /**
     * Controller constructor.
     * @param TradeService $tradeService
     */
    public function __construct(TradeService $tradeService)
    {
        $this->tradeService = $tradeService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function buy(Request $request): JsonResponse
    {
        $previousTrade = $this->tradeService->findPreviousTrade(Trade::SHORT_TYPE);
        if ($previousTrade) {
            $pln = $previousTrade->entry_price - $request->input('price');
            $this->tradeService->update($previousTrade, $request->input('price'), $pln);

            Notification::route('telegram', self::CHAT_ID)
                ->notify(new TradeClosedNotification($previousTrade));
        }
        $trade = $this->tradeService->create(Trade::LONG_TYPE, $request->input('price'));

        Notification::route('telegram', self::CHAT_ID)
            ->notify(new TradeOpenedNotification($trade));

        return response()->json();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sell(Request $request): JsonResponse
    {
        $previousTrade = $this->tradeService->findPreviousTrade(Trade::LONG_TYPE);
        if ($previousTrade) {
            $pln = $request->input('price') - $previousTrade->entry_price;
            $this->tradeService->update($previousTrade, $request->input('price'), $pln);
        }
        $trade = $this->tradeService->create(Trade::SHORT_TYPE, $request->input('price'));

        Notification::route('telegram', self::CHAT_ID)
            ->notify(new TradeOpenedNotification($trade));

        return response()->json();
    }
}
