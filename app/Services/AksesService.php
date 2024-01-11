<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AksesService
{
    public function fromRequest(Request $request): string
    {
        $controller = $request->route()->getActionName();
        return $this->fromController($controller);
    }

    public function isAkses(Collection $userAkses, int $kAkses): bool
    {
        return $userAkses->contains($kAkses);
    }

    public function getUserAkses(User $user, Collection $groupAkses): Collection
    {
        $userAkses = UserAkses::query()
            ->where('id', '=', $user->id)
            ->get();

        $kAkseses = $userAkses->pluck('k_akses');
        return $kAkseses->merge($groupAkses->pluck('k_akses'))->unique();
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