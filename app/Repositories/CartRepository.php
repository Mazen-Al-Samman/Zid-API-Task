<?php

namespace App\Repositories;

use App\Models\Cart;

/** @property Cart $model */
class CartRepository extends BaseRepository
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function findByUserId(int $id): Cart
    {
        $model = $this->model->where('user_id', $id)->first();
        if (empty($model)) {
            $model = $this->model->create(['user_id' => $id]);
        }
        return $model;
    }
}
