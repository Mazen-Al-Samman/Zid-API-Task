<?php

namespace App\Models;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/** @property float $price */
class Product extends Model
{
    use HasFactory;
    use HasTranslations;

    const VAT_FIXED = 'fixed';
    const VAT_PERCENTAGE = 'percentage';
    public $translatable = ['title', 'description'];

    protected $table = 'product';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'store_id', 'price', 'vat_type', 'vat_value'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function priceWithVat()
    {
        if (empty($this->vat_type) || empty($this->vat_value)) return $this->price;
        switch ($this->vat_type) {
            case self::VAT_FIXED:
                return $this->price + $this->vat_value;
            case self::VAT_PERCENTAGE:
                return $this->price + ($this->price * ($this->vat_value / 100));
        }
    }
}
