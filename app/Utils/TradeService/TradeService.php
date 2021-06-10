<?php

namespace App\Utils\TradeService;

use Carbon\Carbon;
use App\Models\Trade;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TradeService
 * @package App\Utils\TradeService
 */
class TradeService
{
    /**
     * @param int $type
     * @param float $price
     * @return Trade|Model
     */
    public function create(int $type, float $price): Trade
    {
        return Trade::query()->create([
            'type' => $type,
            'entry_price' => $price,
            'entry_time' => Carbon::now(),
        ]);
    }

    /**
     * @param Trade|Model $trade
     * @param float $price
     * @param float $pln
     * @return void
     */
    public function update(Trade $trade, float $price, float $pln): void
    {
        $trade->update([
            'exit_price' => $price,
            'exit_time' => Carbon::now(),
            'pln' => $pln,
        ]);
    }

    /**
     * @param int $type
     * @return Trade|Model|null
     */
    public function findPreviousTrade(int $type): ?Trade
    {
        return Trade::query()->where([
            'type' => $type,
            'exit_price' => null,
            'exit_time' => null,
            'pln' => null,
        ])->first();
    }
}
