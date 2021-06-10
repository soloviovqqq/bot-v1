<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Trade
 * @package App\Models
 *
 * @property float $type
 * @property float $entry_price
 * @property float $entry_time
 * @property float $exit_price
 * @property float $exit_time
 * @property float $pln
 */
class Trade extends Model
{
    use HasFactory;

    public const LONG_TYPE = 0;
    public const SHORT_TYPE = 1;

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
}
