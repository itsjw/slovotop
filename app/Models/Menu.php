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
    public function scopeCrm($query)
    {
        if ( ! \Auth::user()->hasRole(1)) {
            $query->whereHas('roles', function ($request) {
                $request->where('access', '>', 0)->whereIn('role_id', \Auth::user()->getRoles());
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

    /**
     * get access menu by slug
     *
     * @return mixed
     */
    public static function getAccessMenu()
    {
        $slug = explode('/', \Request::route()->uri())[1];
        $menu = Menu::where('refer', 1)->where('slug', $slug)->with([
            'roles' => function ($query) {
                $query->whereIn('role_id', \Auth::user()->getRoles())->select('access');
            },
        ])->get();

        foreach ($menu as $val) {
            $access = $val->roles->pluck('access')->toArray();
        }

        return $access[0];
    }
}
