<?php

namespace App\Http\Middleware;

use App\Facade\PermissionReader;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class AuthorizationResource
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $permission = PermissionReader::getPermission($controller, $action);
        if(count($permission)) {
            $permission = $permission[0];
            if(!\Gate::allows("{$permission['name']}/{$permission['resource_name']}")) {
                throw new AuthorizationException("Usuário não autorizado!");
            }
        }
        return $next($request);
    }
}
