<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\user_paper ;
use App\enquiry;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',  'last_login_at','photo',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_papers()
    {
        return $this->hasMany(user_paper::class);
    }

    public function tasks() 
    {
        return $this->hasMany(task_respon::class);
    }
        public function notes() 
    {
        return $this->hasMany(note::class);
    }


    public function enquirys() 
    {
        return $this->hasMany(enquiry::class);
    }


    public function for() 
    {
        return $this->hasMany(enquiry::class,'for_id');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }



}
