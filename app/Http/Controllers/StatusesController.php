<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;
use Auth;
use DB;
class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content'=>$request['content']
        ]);
        session()->flash('success','发布成功');
        return redirect()->back();
    }
    public function destroy(Status $status)
    {
        $this->authorize('destroy',$status);
        $status->delete();
        session()->flash('success','微博删除成功');
        return redirect()->back();
    }
//    public function show(Status $status,Comment $comment)
//    {
//        $sql=DB::table('comments')->select('user_id')->where('status_id',$status->id);
//        $comments=DB::table('comments')->select('content')->where('status_id',$status->id)->get();
//        $names=DB::table('users')->select('name')->joinSub($sql,'comments',function($join){
//            $join->on('users.id','=','comments.user_id');
//        })->get();
//        $ids=DB::table('comments')->select('id')->get();
//        return view('status.detail',compact('status','comments','names','ids','comment'));
//    }
    public function show(Status $status)
    {
        $comments=$status->UserComment()->with('user')->paginate(5,['*'],'spage');
        return view('status.detail',compact('status','comments'));
    }
    public function showComment(Status $status)
    {
        $comments=$status->UserComment()->with('user')->paginate(5,['*'],'spage');
        return $comments;
    }
}
