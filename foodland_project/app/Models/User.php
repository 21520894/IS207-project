<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use DB;
use function Laravel\Prompts\select;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone'
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
        'password' => 'hashed',
    ];
    public function getAllUsers($filters)
    {
        $users = DB::table($this->table)
            ->select('users.*')
            ->where('users.status','<>','locked')
            ->paginate(3);
        if($filters!='')
        {
            $users = DB::table($this->table)
                ->select('users.*')->where('users.role','=',$filters)->where('status','<>','locked')->paginate(3);
        }
        return $users;
    }
    public function getUsersBySearch($filters,$search_string)
    {
        $users = DB::table($this->table)
            ->select('users.*')
            ->where('name','like','%'.$search_string.'%')
            ->where('users.status','<>','locked')
            ->orWhere('phone','like','%'.$search_string.'%')
            ->paginate(3);
        if($filters!='')
        {
            $users = DB::table($this->table)
                ->select('users.*')->where('users.role','=',$filters)
                ->where('name','like','%'.$search_string.'%')
                ->where('users.status','<>','locked')
                ->orWhere('phone','like','%'.$search_string.'%')
                ->paginate(3);
        }
        return $users;
    }
}
