<?php

namespace App\Models\Traits;

use App\Models\Scopes\AktifFilterScope;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Query;

/**
 * @mixin Eloquent\Model
 *
 * @method static Eloquent\Builder|Query\Builder withNonAktif(bool $withNonAktif = true)
 * @method static Eloquent\Builder|Query\Builder onlyNonAktif()
 */
trait AktifFilter
{
    public static function bootAktifFilter(): void
    {
        static::addGlobalScope(new AktifFilterScope());
    }

    public function isAktif(): bool
    {
        return (bool)$this->is_aktif;
    }
}
