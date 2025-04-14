<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $order_id
 * @property int $price
 * @property int $quantity
 * @property string $type
 * @property int $user_id
 * @property int $stock_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static OrderFactory factory($count = null, $state = [])
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereOrderId($value)
 * @method static Builder<static>|Order wherePrice($value)
 * @method static Builder<static>|Order whereQuantity($value)
 * @method static Builder<static>|Order whereStockId($value)
 * @method static Builder<static>|Order whereType($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @method static Builder<static>|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    public const KEY_STOCK_ID = 'stock_id';
    public const KEY_ORDER_ID = 'order_id';
    public const KEY_BUY_ORDER_ID = 'buy_order_id';
    public const KEY_SELL_ORDER_ID = 'sell_order_id';
    public const KEY_PRICE = 'price';
    public const KEY_QUANTITY = 'quantity';
    public const KEY_USER_ID = 'user_id';
    public const KEY_TYPE = 'type';

    protected $primaryKey = 'order_id';

    public $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
