<?php

use App\Models\User;

function user(string $guard = null): User|null
{
    /** @var User|null $res */
    $res = Auth::guard($guard ?: config('auth.defaults.guard'))->user();
    return $res;
}

function userId(string $guard = null): int|null
{
    return user($guard)?->id;
}

function success($data = null, $status = 200, $code = null, $meta = null)
{
    return Response::success($data, $status, $code, $meta);
}