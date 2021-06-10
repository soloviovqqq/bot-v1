<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Trade
 * @package App\Models
 *
 * @property int $type
 * @property string $type_literally
 * @property float $entry_price
 * @property Carbon $entry_time
 * @property float|null $exit_price
 * @property float|null $exit_time
 * @property float|null $pln
 */
class Trade extends Model
{
    use HasFactory;

    public const LONG_TYPE = 1;
    public const SHORT_TYPE = 2;

    public const LONG_TYPE_LITERALLY = 'SHORT';
    public const SHORT_TYPE_LITERALLY = 'LONG';
    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'entry_price',
        'entry_time',
        'exit_price',
        'exit_time',
        'pln',
    ];

    /**
     * @return string
     */
    public function getTypeLiterallyAttribute(): string
    {
        return $this->type === self::LONG_TYPE ? self::LONG_TYPE_LITERALLY : self::SHORT_TYPE_LITERALLY;
    }
}
