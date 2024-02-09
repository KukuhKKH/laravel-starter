<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\Auditable\AuditableWithDeletesTrait;

/**
 * App\Models\User
 *
 * @mixin Eloquent
 *
 * @property      int         $id
 * @property      string      $name
 * @property      string      $email
 * @property      null|Carbon $email_verified_at
 * @property      string      $password
 * @property      null|string $remember_token
 * @property      null|Carbon $created_at
 * @property      null|Carbon $updated_at
 * @property      null|Carbon $deleted_at
 * @property      null|int    $created_by
 * @property      null|int    $updated_by
 * @property      null|int    $deleted_by
 *
 *
 * @method static Builder|User query()
 */
class User extends Authenticatable
{
    use AuditableWithDeletesTrait;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name'              => 'string',
        'email'             => 'string',
        'email_verified_at' => 'datetime',
        'password'          => 'string',
        'remember_token'    => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
        'created_by'        => 'int',
        'updated_by'        => 'int',
        'deleted_by'        => 'int',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
