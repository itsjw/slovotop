<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * User Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    /**
     * Get Roles
     *
     * @param $id
     *
     * @return boolean
     */
    public function hasRole($id): bool
    {
        foreach ($this->role()->get() as $role) {
            if (is_array($id)) {
                if (in_array($role->role_id, $id, true)) {
                    return true;
                }
            } else {
                if ($role->role_id == $id) {
                    return true;
                }
            }
        }

        return false;
    }
}
