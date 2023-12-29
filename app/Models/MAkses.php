<?php

namespace App\Models;

use App\Models\Traits\AktifFilter;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MAkses
 *
 * @property      int                     $k_akses
 * @property      null|string             $singkat
 * @property      null|string             $keterangan
 * @property      null|int                $urutan
 * @property      int                     $is_aktif
 *
 * @property-read Collection|RouteAkses[] $routeAkses
 * @property-read Collection|UserAkses[]  $userAkses
 *
 * @method static Builder|MAkses query()
 */
class MAkses extends Eloquent
{
    use AktifFilter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_akses';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'k_akses';

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
        'singkat'    => 'string',
        'keterangan' => 'string',
        'urutan'     => 'int',
        'is_aktif'   => 'int',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'singkat',
        'keterangan',
        'urutan',
        'is_aktif',
    ];

    /**
     * @return HasMany|RouteAkses
     */
    public function routeAkses(): HasMany|RouteAkses
    {
        return $this->hasMany('App\Models\RouteAkses', 'k_akses', 'k_akses');
    }

    /**
     * @return HasMany|UserAkses
     */
    public function userAkses(): HasMany|UserAkses
    {
        return $this->hasMany('App\Models\UserAkses', 'k_akses', 'k_akses');
    }
}
