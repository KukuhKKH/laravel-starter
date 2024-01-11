<?php

namespace App\Http\Middleware;

use App\Models\RouteAkses;
use App\Models\User;
use App\Services\AksesService;
use App\Services\AkunService;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class Akses
{
    public function __construct(
        protected AksesService $aksesService,
        protected AkunService $akunService,
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key        = $this->aksesService->fromRequest($request);
        $routeAkses = RouteAkses::query()
            ->with('route')
            ->where('route_key', '=', $key)
            ->first();

        $user       = user();
        $groupAkses = $this->akunService->getGrupAkses($user);
        $userAkses  = $this->aksesService->getUserAkses($user, $groupAkses);

        if ($routeAkses && !$this->aksesService->isAkses($userAkses, $routeAkses->k_akses)) {
            throw new AuthorizationException("Akun tidak memiliki akses");
        }

        if ($routeAkses) {
            foreach ($request->route()->parameters() as $model) {

                if (!($model instanceof Model) || !method_exists($model, 'getPolicyName')) {
                    continue;
                }

                if ($ability = $model->getPolicyName($routeAkses->route->key)) {
                    $inspect = Gate::inspect($ability, $model);
                    if ($inspect->denied()) {
                        throw new AuthorizationException($inspect->message());
                    }
                }
            }
        }

        return $next($request);
    }
}
