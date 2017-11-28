<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleSaveValidation;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Roles\Role as RoleResource;
use App\Http\Controllers\Controller;

/**
 * Class RoleController
 * @package App\Http\Controllers\Api
 */
class RoleController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getRoles(Request $request)
    {
        $role = Role::query();

        if (isset($request->id)) {
            $role->where('id', $request->id);
        }

        return RoleResource::collection($role->get());
    }

    /**
     * @param RoleSaveValidation $request
     *
     * @return array
     */
    public function saveRole(RoleSaveValidation $request)
    {
        $role = Role::findOrNew($request->id);

        $role->name = $request->name;
        $role->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function deleteRole(Request $request)
    {
        foreach ($request->items as $key) {
            $role = Role::find($key['id']);
            if (!$role->users()->count()) {
                $role->delete();
            }
        }

        return ['success' => trans('data.notifyOK')];
    }
}
