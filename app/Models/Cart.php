<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    use Timestamp;

    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';

    protected $table = 'cart';

    protected $fillable = [
        'user_id', 'status'
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetails::class, 'cart_id', 'id');
    }
}
