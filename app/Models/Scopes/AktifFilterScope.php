<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AktifFilterScope implements Scope
{
    protected array $extensions = [
        'WithNonAktif',
        'OnlyNonAktif',
    ];

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where("{$model->getTable()}.is_aktif", '=', 1);
    }

    public function extend(Builder $builder): void
    {
        foreach ($this->extensions as $extension) {
            $this->{"add$extension"}($builder);
        }
    }

    protected function addWithNonAktif(Builder $builder): void
    {
        $builder->macro('withNonAktif', function (Builder $builder, bool $withNonAktif = true) {
            if ($withNonAktif) {
                $builder->withoutGlobalScope($this);
            }

            return $builder;
        });
    }

    protected function addOnlyNonAktif(Builder $builder): void
    {
        $builder->macro('onlyNonAktif', function (Builder $builder) {
            return $builder
                ->withoutGlobalScope($this)
                ->where('is_aktif', '=', 0);
        });
    }
}
