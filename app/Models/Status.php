<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=['content'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function UserLike()
    {
        return $this->belongsToMany(User::class,'user_likes','status_id','user_id');
    }
    public function UserComment()
    {
        return $this->hasMany(Comment::class);
    }
}
