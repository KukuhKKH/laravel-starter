<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AksesService
{
    public function fromRequest(Request $request): string
    {
        $controller = $request->route()->getActionName();
        return $this->fromController($controller);
    }

    public function isAkses(User $user, int $kAkses): bool
    {
        return UserAkses::query()
            ->where('k_akses', '=', $kAkses)
            ->where('id', '=', $user->id)
            ->exists();
    }

    /**
     * @param $controller
     *
     * @return string
     */
    protected function fromController($controller): string
    {
        $controller = Str::replace('App\\Http\\Controllers\\', '', $controller);
        $controller = Str::replace('Controller@', '.', $controller);
        $controller = Str::replace('\\', '', $controller);

        return Str::lower(Str::snake($controller, '-'));
    }
}