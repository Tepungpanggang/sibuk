<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'nis',
        'email',
        'phone',
        'address',
        'photo_path',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) {
            return null;
        }

        return route('profile.photo.show', [
            'user' => $this->id,
            'v' => $this->updated_at?->timestamp,
        ]);
    }

    public function getInitialsAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->username, 0, 2));
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}