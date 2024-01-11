<?php

namespace App\Models\Traits;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

/**
 * @method static retrieved(Closure $param)
 * @method append(string $string)
 */
trait HasPolicies
{
    protected static array $withPolicies = [];

    public static function bootHasPolicies(): void
    {
        static::retrieved(function(Model $model) {
            if (isset(static::$withPolicies[get_class($model)])) {
                $model->append('policies');
            }
        });
    }

    public function showPolicies($with = '*'): static
    {
        if ($with) {
            static::$withPolicies[static::class] = $with;
            $this->append('policies');
        }

        return $this;
    }

    public static function withPolicies($with = '*'): void
    {
        if ($with) {
            static::$withPolicies[static::class] = $with;
        }
    }

    abstract public function policies(): array;

    public function getPoliciesAttribute(): array
    {
        $withs    = static::$withPolicies[get_class($this)] ?? null;
        $maps     = $this->policies();
        $policies = [];
        foreach ($maps as $akses => $ability) {

            if (is_array($withs) && !in_array($akses, $withs)) {
                continue;
            } elseif (is_string($withs)) {
                if (!Str::is($withs, $akses)) {
                    continue;
                }
            }

            $policies[$akses] = Gate::allows($ability, [$this]);
        }

        return $policies;
    }

    public function getPolicyName($akses)
    {
        $policies = $this->policies();
        return $policies[$akses] ?? null;
    }

}
