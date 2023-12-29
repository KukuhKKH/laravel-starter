<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Routes
 *
 * @property      string                  $key
 * @property      string                  $label
 * @property      null|Carbon             $created_at
 * @property      null|Carbon             $updated_at
 *
 * @property-read Collection|RouteAkses[] $routeRouteAkses
 *
 * @method static Builder|Routes query()
 */
class Routes extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'routes';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'key'        => 'string',
        'label'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'key',
        'label',
    ];

    /**
     * @return HasMany|RouteAkses
     */
    public function routeRouteAkses(): HasMany|RouteAkses
    {
        return $this->hasMany('App\Models\RouteAkses', 'route_key', 'key');
    }
}
