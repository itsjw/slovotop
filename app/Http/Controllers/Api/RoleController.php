<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

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
}
