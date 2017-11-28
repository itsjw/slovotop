<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\Menus\Menu as MenuResource;
use App\Http\Controllers\Controller;

/**
 * Class MenuController
 * @package App\Http\Controllers\Api
 */
class MenuController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getMenus(Request $request)
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
