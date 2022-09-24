<?php

namespace App\Helpers;

use App\Interfaces\SerializerInterface;
use App\Models\Store;

class StoreSerializer implements SerializerInterface
{
    public $model;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public static function get($collection): array
    {
        $response = [];
        foreach ($collection as $model) {
            $categoryModel = $model->category;
            $response[] = [
                'id' => $model->id,
                'name' => $model->name,
                'description' => $model->description,
                'slug' => $model->slug,
                'category' => [
                    'label' => $categoryModel->label,
                    'description' => $categoryModel->description
                ]
            ];
        }
        return $response;
    }
}
