<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;

/**
 * Class AccessRoute
 *
 * @package App\Http\Middleware
 */
class AccessRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = explode('/', $request->route()->uri())[1];

        $query = Menu::query()->where('refer', 1)->where('slug', $slug);

        $query->whereHas('roles', function ($request) {
            $request->whereIn('role_id', \Auth::user()->getRoles())->where('access', 1);
        });

        if ($query->get()->isEmpty()&& ! \Auth::user()->hasRole(1)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
