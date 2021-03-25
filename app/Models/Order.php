<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    private const CASH = 'cash';

    public const PAYMENT_METHODS = [
        self::CASH
    ];

    protected $fillable = [
        'user_id',
        'payment_method'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
