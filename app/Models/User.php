<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\Auditable\AuditableWithDeletesTrait;

/**
 * App\Models\User
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property null|Carbon $email_verified_at
 * @property string      $password
 * @property null|string $remember_token
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 * @property null|Carbon $deleted_at
 * @property null|int    $created_by
 * @property null|int    $updated_by
 * @property null|int    $deleted_by
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
     * @var array
     */
    protected $casts = [
        'name'              => 'string',
        'email'             => 'string',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
