<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function gravatar($size='100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user){
            $user->activation_token=str::random(10);
        });
    }
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
    public function feed()
    {
        $user_ids=$this->following->pluck('id')->toArray();
        array_push($user_ids,$this->id);
        return Status::whereIn('user_id',$user_ids)->with('user')->orderBy('created_at','desc');
    }
    public function fans()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    public function following()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }
    public function UserLike()
    {
        return $this->belongsToMany(Status::class,'user_likes','user_id','status_id');
    }
    public function follow($user_ids)
    {
        if(!is_array($user_ids))
        {
            $user_ids=compact('user_ids');
        }
        $this->fans()->sync($user_ids,false);
    }
    public function unfollow($user_ids)
    {
        if(!is_array($user_ids))
        {
            $user_ids=compact('user_ids');
        }
        $this->fans()->detach($user_ids);
    }
    public function isFollowing($user_id)
    {
        return $this->fans->contains($user_id);
    }
    public function liked($status_id)
    {
        return $this->UserLike->contains($status_id);
    }
    public function like($status_ids)
    {
        if(!is_array($status_ids))
        {
            $status_ids=compact('status_ids');
        }
        $this->UserLike()->sync($status_ids);
    }
    public function unlike($status_ids)
    {
        if(!is_array($status_ids))
        {
            $status_ids=compact('status_ids');
        }
        $this->UserLike()->detach($status_ids);
    }
}
