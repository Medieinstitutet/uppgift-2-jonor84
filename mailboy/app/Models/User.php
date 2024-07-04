<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'type',
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

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user has the given role(s).
     *
     * @param string|array $roles
     * @return bool
     */

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            return $this->roles()->whereIn('name', $roles)->exists();
        }

        return $this->roles()->where('name', $roles)->exists();
    }

    public function hasAnyRole(...$roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * Get the newsletters for the subscriber.
     */
    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class, 'newsletters_subscribers', 'user_id', 'newsletter_id');
    }

    /**
     * Get the newsletters created by the client user.
     */

    public function mynewsletters()
    {
        return $this->hasMany(Newsletter::class, 'addeduid');
    }
}
