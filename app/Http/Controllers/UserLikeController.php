<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;
use Auth;
class UserLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Status $status)
    {
        if(!Auth::user()->liked($status->id))
        {
            Auth::user()->like($status->id);
        }
        return redirect()->back();
    }
    public function cancle(Status $status)
    {
        if(Auth::user()->liked($status->id))
        {
            Auth::user()->unlike($status->id);
        }
        return redirect()->back();
    }
    public function liked(int $id)
    {
        return response()->json([
            'data' =>  Auth::user()->liked($id)?true:false
        ]);
    }
    public function store_comment(Comment $comment)
    {
        if(!Auth::user()->liked_comment($comment->id))
        {
            Auth::user()->like_comment($comment->id);
        }
        return redirect()->back();
    }
    public function cancle_comment(Comment $comment)
    {
        if(Auth::user()->liked_comment($comment->id))
        {
            Auth::user()->unlike_comment($comment->id);
        }
        return redirect()->back();
    }
    public function liked_comment(int $id)
    {
        return response()->json([
            'data' =>  Auth::user()->liked_comment($id)?true:false
        ]);
    }
}
