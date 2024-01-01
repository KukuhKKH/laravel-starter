<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GrupAnggota
 *
 * @property      int         $id
 * @property      int         $k_grup
 * @property      int         $k_grup_anggota
 * @property      null|Carbon $created_at
 * @property      null|Carbon $updated_at
 *
 * @property-read MGrup       $grupAnggota
 * @property-read MGrup       $mGrup
 *
 * @method static Builder|GrupAnggota query()
 */
class GrupAnggota extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grup_anggota';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'k_grup'         => 'int',
        'k_grup_anggota' => 'int',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'k_grup',
        'k_grup_anggota',
    ];

    /**
     * @return BelongsTo|MGrup
     */
    public function grupAnggota(): BelongsTo|MGrup
    {
        return $this->belongsTo('App\Models\MGrup', 'k_grup_anggota', 'k_grup');
    }

    /**
     * @return BelongsTo|MGrup
     */
    public function mGrup(): BelongsTo|MGrup
    {
        return $this->belongsTo('App\Models\MGrup', 'k_grup', 'k_grup');
    }
}
