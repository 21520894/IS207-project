<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Admin extends Authenticatable implements AuthenticatableContract
{

    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'admin';
    protected $primaryKey = 'AdminID';
    public $timestamps = false;
    protected $username = 'Username';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Username',
        'AdminType',
        'Password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    // Các trường khác trong Model
    public function getAuthPassword()
    {
        return $this->Password;
    }
    public function getAuthIdentifierName()
{
    return 'Username';
}
}
