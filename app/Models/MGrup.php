<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MGrup
 *
 * @property      int                      $k_grup
 * @property      null|string              $singkat
 * @property      null|string              $keterangan
 *
 * @property-read Collection|GrupAkses[]   $grupAkses
 * @property-read Collection|GrupAnggota[] $grupAnggota
 * @property-read Collection|GrupAnggota[] $grupAnggotas
 * @property-read Collection|UserGrup[]    $userGrups
 *
 * @method static Builder|MGrup query()
 */
class MGrup extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_grup';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'k_grup';

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
    ];

    /**
     * @return HasMany|GrupAkses
     */
    public function grupAkses(): HasMany|GrupAkses
    {
        return $this->hasMany('App\Models\GrupAkses', 'k_grup', 'k_grup');
    }

    /**
     * @return HasMany|GrupAnggota
     */
    public function grupAnggota(): HasMany|GrupAnggota
    {
        return $this->hasMany('App\Models\GrupAnggota', 'k_grup', 'k_grup');
    }

    /**
     * @return HasMany|GrupAnggota
     */
    public function grupAnggotas(): HasMany|GrupAnggota
    {
        return $this->hasMany('App\Models\GrupAnggota', 'k_grup_anggota', 'k_grup');
    }

    /**
     * @return HasMany|UserGrup
     */
    public function userGrups(): HasMany|UserGrup
    {
        return $this->hasMany('App\Models\UserGrup', 'k_grup', 'k_grup');
    }
}
