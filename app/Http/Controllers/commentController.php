<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;

class commentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment'=>'required|max:255',
            'status_id'=>'required'
        ]);
        if($request->comment!=='')
        {
            Auth::user()->UserComment()->create([
                'content'=>$request->comment,
                'status_id'=>$request->status_id,
                'parent'=>$request->parent
                ]);
        }
    }
    public function count(Status $status)
    {
        $count=$status->UserComment->last()->id;
        return response()->json([
            'count'=>$count
        ]);
    }
    public function getPage(Paginator $paginator,int $page)
    {
        return $paginator;
    }
    public function findSon(int $id)
    {
        $sons=DB::table('comments')->where('parent',$id)->paginate(5,['*'],'cpage'.$id);
//        $sons->withPath('./son');
        return $sons;
    }

}
