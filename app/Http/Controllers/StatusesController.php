<?php

namespace App\Http\Controllers;

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
    public function show(Status $status)
    {
        $sql=DB::table('comments')->select('user_id')->where('status_id',$status->id);
//        $sql_result= ['content'=>DB::table('comments')->select('content')->where('status_id',$status->id)->get(),
//            'user'=>DB::table('users')->select('name')->joinSub($sql,'comments',function($join){
//                $join->on('users.id','=','comments.user_id');
//            })->get()];
        $comments=DB::table('comments')->select('content')->where('status_id',$status->id)->get();
        $names=DB::table('users')->select('name')->joinSub($sql,'comments',function($join){
            $join->on('users.id','=','comments.user_id');
        })->get();
        return view('status.detail',compact('status','comments','names'));
    }
}
