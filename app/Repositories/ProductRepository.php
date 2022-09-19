<?php

namespace App\Repositories;

use App\Models\Product;

/** @property Product $model */
class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create($attributes): Product
    {
        $attributes['store_id'] = auth()->user()->store->id;
        $this->model = $this->model->create($attributes);
        return $this->model;
    }

    public function listAll($perPage = 10): array
    {
        $allProducts = Product::paginate($perPage);
        $result = [];
        foreach ($allProducts as $product) {
            $storeModel = $product->store;
            $result[] = [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'priceWithVat' => $product->priceWithVat(),
                'store' => [
                    'id' => $storeModel->id,
                    'name' => $storeModel->name,
                    'description' => $storeModel->description
                ]
            ];
        }
        return $result;
    }

    public static function getById($id): ?array
    {
        $productModel = Product::where('id', $id)->first();
        if (empty($productModel)) return null;
        $storeModel = $productModel->store;
        return [
            'id' => $productModel->id,
            'title' => $productModel->title,
            'description' => $productModel->description,
            'price' => $productModel->price,
            'priceWithVat' => $productModel->priceWithVat(),
            'store' => [
                'id' => $storeModel->id,
                'name' => $storeModel->name,
                'description' => $storeModel->description
            ]
        ];
    }
}
