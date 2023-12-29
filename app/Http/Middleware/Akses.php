<?php

namespace App\Http\Middleware;

use App\Models\RouteAkses;
use App\Services\AksesService;
use App\Services\AkunService;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
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

        if ($routeAkses && !$this->aksesService->isAkses(user(), $routeAkses->k_akses)) {
            throw new AuthorizationException("Akun tidak memiliki akses {$routeAkses->route->label}");
        }

        return $next($request);
    }
}
