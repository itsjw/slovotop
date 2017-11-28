<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AccessController
 * @package App\Http\Controllers\Api
 */
class AccessController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function saveAccessMenu(Request $request)
    {
        $menu = Menu::find($request->menu)->roles()->where('role_id', $request->role);

        if ($menu->exists()) {
            $menu->updateExistingPivot($request->role, ['access' => $request->access]);
        } else {
            $role = Role::find($request->role);
            $menu->save($role, ['access' => $request->access]);
        }

        return ['success' => trans('data.notifyOK')];
    }
}