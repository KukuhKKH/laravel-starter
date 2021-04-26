<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class ApiCheckTokenUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::findToken($request->api_token);
        if(!$request->api_token || !$user || $user->status == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Api Token Tidak Ditemukan atau User tidak aktif'
            ]);
        }
        return $next($request);
    }
}
