<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\Menus\Menu as MenuResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MenuController
 * @package App\Http\Controllers\Api
 */
class MenuController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Menu
     * @apiPermission auth
     * @api           {post} getMenus getMenus(s)
     * @apiName       getMenus
     * @apiParam {Integer} id ID if need one
     * @apiParam {Integer} role role
     * @apiParamExample {json} Request-Example:
     * {id: 1,role:'2}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Object} roles roles{access}
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getMenus(Request $request): ResourceCollection
    {
        $menu = Menu::query();

        if (isset($request->id)) {
            $menu->where('id', $request->id);
        }
        if (isset($request->role)) {
            $role = $request->role;
            $menu->with([
                'roles' => function ($query) use ($role) {
                    $query->where('role_id', $role)->select('access');
                },
            ]);
        }

        return MenuResource::collection($menu->get());
    }
}
