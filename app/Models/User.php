<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/** @property integer $id */
/** @property string $first_name */
/** @property string $last_name */
/** @property string $email */

/** @property string $password */
class User extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $guarded = ['*'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
