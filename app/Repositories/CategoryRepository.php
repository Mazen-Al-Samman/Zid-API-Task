<?php

namespace App\Repositories;

use App\Models\Category;

/** @property Category $model */
class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function listAll(): array
    {
        $result = [];
        $allCategories = Category::all();
        foreach ($allCategories as $category) {
            $result[] = [
                'id' => $category->id,
                'label' => $category->label,
                'description' => $category->description,
            ];
        }
        return $result;
    }
}
