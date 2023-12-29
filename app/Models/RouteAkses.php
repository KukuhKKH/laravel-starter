<?php

namespace App\Models;

use App\Models\Traits\AktifFilter;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RouteAkses
 *
 * @property      int         $id
 * @property      string      $route_key
 * @property      int         $k_akses
 * @property      int         $is_aktif
 * @property      null|Carbon $created_at
 * @property      null|Carbon $updated_at
 * @property      null|int    $created_by
 * @property      null|int    $updated_by
 *
 * @property-read MAkses      $mAkses
 * @property-read Routes      $route
 *
 * @method static Builder|RouteAkses query()
 */
class RouteAkses extends Eloquent
{
    use AktifFilter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'route_akses';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'route_key'  => 'string',
        'k_akses'    => 'int',
        'is_aktif'   => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'int',
        'updated_by' => 'int',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'route_key',
        'k_akses',
        'is_aktif',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsTo|MAkses
     */
    public function mAkses(): BelongsTo|MAkses
    {
        return $this->belongsTo('App\Models\MAkses', 'k_akses', 'k_akses');
    }

    /**
     * @return BelongsTo|Routes
     */
    public function route(): BelongsTo|Routes
    {
        return $this->belongsTo('App\Models\Routes', 'route_key', 'key');
    }
}
