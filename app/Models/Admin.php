<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';

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

    // Check if admin has a specific role
    public function hasRole($role)
    {
        return $this->role === $role || $this->role === 'superadmin';
    }

    // Can delete any review or location
    public function canDeleteReview($review)
    {
        return $this->hasRole('admin');
    }

    public function canDeleteLocation($location)
    {
        return $this->hasRole('admin');
    }
}
