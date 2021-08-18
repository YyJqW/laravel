<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{
    protected $fillable=['content','status_id','parent'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function UserLikeComment()
    {
        return $this->belongsToMany(User::class,'user_likes_comments','comment_id','user_id');
    }
    public function liked_count()
    {
        $count=count($this->UserLikeComment->all());
        return response()->json([
            'count'=>$count
        ]);
    }
    public function findSon()
    {
        $sons=$this->where('parent',$this->id)->paginate(5,['*'],'cpage'.$this->id);
//        $sons->withPath('./son');
        return $sons;
    }
}
