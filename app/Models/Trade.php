<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trade extends Model
{
    protected $fillable = [
        'receiving_user_id',
        'sending_user_id',
        'receiving_item_id',
        'sending_item_id',
        'receiving_quantity',
        'sending_quantity',
        'accepted',
    ];

    public function receivingUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiving_user_id');
    }

    public function sendingUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sending_user_id');
    }

    public function receivingItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'receiving_item_id');
    }

    public function sendingItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'sending_item_id');
    }
}
