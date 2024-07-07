<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;

function user(string $guard = null): ?User
{
    /** @var ?User */
    return Auth::guard($guard ?: config('auth.defaults.guard'))->user();
}

function userId(string $guard = null): ?int
{
    return user($guard)?->id;
}
