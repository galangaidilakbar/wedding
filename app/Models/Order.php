<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property string $id
 * @property int $user_id
 * @property int $address_id
 * @property \Illuminate\Support\Carbon $tanggal_acara
 * @property string $opsi_bayar
 * @property string $metode_pembayaran
 * @property string|null $catatan
 * @property string $total_dp
 * @property string $total_harga
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address $address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetailOrder> $detail_orders
 * @property-read int|null $detail_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payments> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Timeline> $timelines
 * @property-read int|null $timelines_count
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOpsiBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTanggalAcara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalDp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 *
 * @property string $status_color
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusColor($value)
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = ['id'];

    // DP 30%
    public const DP = 0.30;

    // The order is cancelled
    public const CANCELLED = 'Dibatalkan';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detail_orders(): HasMany
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class)->withTrashed();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payments::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    // The attributes that should be cast.
    protected $casts = [
        'tanggal_acara' => 'datetime',
    ];
}
