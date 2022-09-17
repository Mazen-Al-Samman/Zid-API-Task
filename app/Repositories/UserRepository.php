<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

/** @property User $model */
class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @throws Exception
     */
    public function create(): ?User
    {
        if (empty($this->model)) throw new Exception("There is no model to save!");
        $this->model->password = Hash::make($this->model->password);
        if (!$this->model->save()) return null;
        return $this->model;
    }
}
