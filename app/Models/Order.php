<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /*
     * Getters DP
     * @return float
     */
    public const DP = 0.30;

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
