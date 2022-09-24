<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function create(int $cart_id, int $user_id)
    {
        return $this->model->create([
            'user_id' => $user_id,
            'cart_id' => $cart_id,
            'status' => Order::STATUS_COMPLETED
        ]);
    }
}
