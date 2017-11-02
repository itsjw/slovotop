<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'confirm',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(UserTask::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastLogin()
    {
        return $this->hasOne(LastLogin::class, 'user_id', 'id');
    }

    /**
     * get has Roles
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

    /**
     * get user roles
     *
     * @return array
     */
    public function getRoles(): array
    {
        foreach ($this->roles()->get() as $key) {
            $roles[] = $key->role_id;
        }

        return $roles;
    }
}
