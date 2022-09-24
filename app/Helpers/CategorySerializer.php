<?php

namespace App\Helpers;

use App\Interfaces\SerializerInterface;
use App\Models\Category;

class CategorySerializer implements SerializerInterface
{
    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public static function get($collection): array
    {
        $response = [];
        foreach ($collection as $model) {
            $response[] = [
                'label' => $model->label,
                'description' => $model->description,
            ];
        }
        return $response;
    }
}
