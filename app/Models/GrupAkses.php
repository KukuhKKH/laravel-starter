<?php

namespace App\Models;

use App\Models\Traits\AktifFilter;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GrupAkses
 *
 * @property      int         $id
 * @property      int         $k_grup
 * @property      int         $k_akses
 * @property      string      $duplikasi
 * @property      int         $is_aktif
 * @property      null|Carbon $created_at
 * @property      null|Carbon $updated_at
 * @property      null|int    $created_by
 * @property      null|int    $updated_by
 *
 * @property-read MAkses      $mAkses
 * @property-read MGrup       $mGrup
 *
 * @method static Builder|GrupAkses query()
 */
class GrupAkses extends Eloquent
{
    use AktifFilter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grup_akses';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'k_grup'     => 'int',
        'k_akses'    => 'int',
        'duplikasi'  => 'string',
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
        'k_grup',
        'k_akses',
        'duplikasi',
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
     * @return BelongsTo|MGrup
     */
    public function mGrup(): BelongsTo|MGrup
    {
        return $this->belongsTo('App\Models\MGrup', 'k_grup', 'k_grup');
    }
}
