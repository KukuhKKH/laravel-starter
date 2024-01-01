<?php

namespace App\Models;

use App\Models\Traits\AktifFilter;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserGrup
 *
 * @property      int         $id
 * @property      int         $user_id
 * @property      int         $k_grup
 * @property      int         $is_aktif
 * @property      null|Carbon $created_at
 * @property      null|Carbon $updated_at
 * @property      null|int    $created_by
 * @property      null|int    $updated_by
 *
 * @property-read MGrup       $mGrup
 * @property-read User        $user
 *
 * @method static Builder|UserGrup query()
 */
class UserGrup extends Eloquent
{
    use AktifFilter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_grup';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id'    => 'int',
        'k_grup'     => 'int',
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
        'user_id',
        'k_grup',
        'is_aktif',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsTo|MGrup
     */
    public function mGrup(): BelongsTo|MGrup
    {
        return $this->belongsTo('App\Models\MGrup', 'k_grup', 'k_grup');
    }

    /**
     * @return BelongsTo|User
     */
    public function user(): BelongsTo|User
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
