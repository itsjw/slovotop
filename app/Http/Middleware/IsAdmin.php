<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Auth;
use Closure;

/**
 * Class IsAdmin
 *
 * @package App\Http\Middleware
 */
class IsAdmin
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
        if ( ! in_array(1, Auth::user()->getRoles(), true)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
