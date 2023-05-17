<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DetailOrder
 *
 * @property int $id
 * @property string $order_id
 * @property string $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DetailOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
