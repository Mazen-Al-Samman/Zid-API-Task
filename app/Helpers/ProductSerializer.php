<?php

namespace App\Helpers;

use App\Interfaces\SerializerInterface;
use App\Models\Product;

class ProductSerializer implements SerializerInterface
{
    public $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public static function get($collection): array
    {
        $response = [];
        foreach ($collection as $model) {
            $response[] = [
                'id' => $model->id,
                'title' => $model->title,
                'description' => $model->description,
                'base_price' => $model->price,
                'full_price' => $model->priceWithVat()
            ];
        }
        return $response;
    }
}
