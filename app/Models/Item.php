<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rarity_id',
        'type_id',
        'power',
        'speed',
        'durability',
        'magic',
    ];

    public function rarity()
    {
        return $this->belongsTo(Rarity::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_item', 'item_id', 'user_id')->withPivot('quantity');
    }
}
