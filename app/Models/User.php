<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App
 * @property-read int $id
 * @property string $email
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Guarded fields list
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get owner relation
     *
     * @return MorphOne
     */
    public function abstract_owner()
    {
        return $this->morphOne(Owner::class, 'owner');
    }
}
