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
    public function create($attributes): ?User
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->model->create($attributes);
    }
}
