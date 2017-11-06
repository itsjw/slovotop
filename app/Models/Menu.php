<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 *
 * @package App\Models
 */
class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'icon', 'role_id'];

    /**
     * get crm menu by role_id
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeCrm($query) //TODO
    {
        if ( ! \Auth::user()->hasRole(1)) {
            $query->whereHas('roles', function ($request) {
                $request->where('access', 1)->whereIn('role_id', \Auth::user()->getRoles());
            });
        }

        return $query->where('refer', 1)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function roles()
    {
        return $this->morphToMany(Role::class, 'accessable');
    }
}
