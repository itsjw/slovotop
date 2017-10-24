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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project()
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }

    /**
     * User Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
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
        foreach ($this->roles()->get() as $role) {
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
