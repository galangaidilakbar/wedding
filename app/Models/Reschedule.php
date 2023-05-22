<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reschedule extends Model
{
    use HasFactory;

    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'old_date' => 'date',
        'new_date' => 'date',
    ];

    public const STATUS = [
        'PENDING' => 'Menunggu Konfirmasi',
        'APPROVED' => 'Disetujui',
        'REJECTED' => 'Ditolak',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
