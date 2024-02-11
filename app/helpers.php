<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;

function user(string $guard = null): ?User
{
    /** @var User|null */
    return Auth::guard($guard ?: config('auth.defaults.guard'))->user();
}

function userId(string $guard = null): ?int
{
    return user($guard)?->id;
}

function success($data = null, $status = 200, $code = null, $meta = null): JsonResponse
{
    return Response::success($data, $status, $code, $meta);
}
