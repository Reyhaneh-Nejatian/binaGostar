<?php

namespace arghavan\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use arghavan\Media\Models\Media;
use arghavan\RolePermissions\Models\Role;
use arghavan\User\Notifications\ResetPasswordRequestNotification;
use arghavan\User\Notifications\VerifyMailNotification;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    public static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN,
    ];

    public static $defultUser = [
        [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'name' => 'Admin',
            'role' => Role::ROLE_SUPER_ADMIN,
        ]
    ];

    protected $fillable = [
        'name',
        'status',
        'email',
        'mobile',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class,'image_id');
    }

    public function getThumbAttribute()
    {
        if($this->image)

        return '/storage/'.$this->image->files[300];

        return 'Panel/img/profile.jpg';
    }
}
