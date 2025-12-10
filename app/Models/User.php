<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah pembeli
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    
    /**
     * Scope untuk admin
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }
    
    /**
     * Scope untuk user
     */
    public function scopeUser($query)
    {
        return $query->where('role', 'user');
    }
}