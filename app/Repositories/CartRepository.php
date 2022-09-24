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

    public function getPendingCart(int $id)
    {
        return $this->model
            ->where('user_id', $id)
            ->where('status', Cart::STATUS_PENDING)
            ->first();
    }

    public function findByUserId(int $id): Cart
    {
        $model = $this->model
            ->where('user_id', $id)
            ->where('status', Cart::STATUS_PENDING)
            ->first();

        if (empty($model)) {
            $model = $this->model->create([
                'user_id' => $id,
                'status' => Cart::STATUS_PENDING
            ]);
        }
        return $model;
    }

    public function confirmCheckout($cart)
    {
        return $cart->update(['status' => Cart::STATUS_DONE]);
    }
}
