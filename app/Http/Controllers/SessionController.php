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
        if (Auth::attempt($credential,$request->has('remember')))
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
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','成功退出');
        return redirect()->route('login');
    }
}
