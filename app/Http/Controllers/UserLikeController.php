<?php

namespace App\Http\Controllers;

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
}
