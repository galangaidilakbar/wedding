<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payments
 *
 * @property string $id
 * @property string $order_id
 * @property string $proof_of_payment
 * @property string $proof_of_payment_url
 * @property string $status
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereProofOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereProofOfPaymentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Payments extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public const STATUS = [
        // determine the payment is waiting for confirmation
        'WAITING_FOR_CONFIRMATION' => 'Menunggu Konfirmasi',

        // determine the payment is accepted
        'PAYMENT_ACCEPTED' => 'Pembayaran Diterima',

        // determine the payment is rejected
        'PAYMENT_REJECTED' => 'Pembayaran Ditolak',

        // determine the payment is refunded
        'PAYMENT_REFUNDED' => 'Pembayaran Telah Dikembalikan',
    ];
}
