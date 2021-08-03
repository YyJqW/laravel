<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class commentController extends Controller
{
    public function store(Request $request,$status_id)
    {
        $request->validate([
            'comment'=>'required|max:255'
        ]);
        $data=[];
        $data['comment']=$request->comment;
        if($data['comment']!=='')
        {
            Auth::user()->addComment($status_id);
            Auth::user()->UserComment()->update($data);
        }
    }
}
