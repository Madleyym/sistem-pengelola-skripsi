<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define role constants
    const ROLE_ADMIN = 'admin';
    const ROLE_DOSEN = 'dosen';
    const ROLE_MAHASISWA = 'mahasiswa';

    // check if user is an admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDosen()
    {
        return $this->role === self::ROLE_DOSEN;
    }

    public function isMahasiswa()
    {
        return $this->role === self::ROLE_MAHASISWA;
    }

    // Relationship with dosen
    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    // Relationship with mahasiswa
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
}
