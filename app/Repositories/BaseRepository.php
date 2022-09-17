<?php

namespace App\Repositories;

class BaseRepository
{
    public $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function load(array $requestData): ?BaseRepository
    {
        if (empty($this->model)) return null;
        $modelAttributes = $this->model->getFillable();
        foreach ($modelAttributes as $attribute) {
            $this->model->{$attribute} = $requestData[$attribute];
        }
        return $this;
    }
}
