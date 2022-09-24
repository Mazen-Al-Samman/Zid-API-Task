<?php

namespace App\Repositories;

use App\Models\CartDetails;
use App\Models\Product;

/** @property CartDetails $model */
class CartDetailsRepository extends BaseRepository
{
    public function __construct(CartDetails $model)
    {
        parent::__construct($model);
    }

    public function addToCart($attributes)
    {
        return $this->model->create($attributes);
    }
}
