<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionController extends Controller
{
    public function create()
    {
        return view('session.create');
    }
    public function store(Request $request)
    {
        $credential = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);
        if (Auth::attempt($credential))
        {
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);
        }
        else
        {
            session()->flash('danger','邮箱不正确或者密码不匹配');
            return redirect()->back()->withInput();
        }

        return;
    }
}
