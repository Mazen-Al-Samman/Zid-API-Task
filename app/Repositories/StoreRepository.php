<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Support\Str;

/** @property Store $model */
class StoreRepository extends BaseRepository
{
    public function __construct(Store $model)
    {
        parent::__construct($model);
    }

    public function create($attributes): Store
    {
        $attributes['user_id'] = auth()->id();
        $attributes['slug'] = Str::slug($attributes['name']['en']) . '-store';
        $this->model->create($attributes);
        return $this->model;
    }

    public function update($attributes): Store
    {
        $this->model = Store::where(['id' => $attributes['id']])->first();
        $attributes['slug'] = Str::slug($attributes['name']['en']) . '-store';
        $this->model->update($attributes);
        return $this->model;
    }

    public static function getBySlug($slug)
    {
        return Store::with('category')->where('slug', $slug)->get();
    }
}
