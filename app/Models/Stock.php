<?php

namespace App\Models;

use Database\Factories\StockFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $stock_id
 * @property string $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static StockFactory factory($count = null, $state = [])
 * @method static Builder<static>|Stock newModelQuery()
 * @method static Builder<static>|Stock newQuery()
 * @method static Builder<static>|Stock query()
 * @method static Builder<static>|Stock whereCreatedAt($value)
 * @method static Builder<static>|Stock whereStockId($value)
 * @method static Builder<static>|Stock whereSymbol($value)
 * @method static Builder<static>|Stock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    /** @use HasFactory<StockFactory> */
    use HasFactory;

    protected $primaryKey = 'stock_id';
}
