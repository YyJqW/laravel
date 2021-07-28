<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create']
        ]);
        $this->middleware('throttle:10,10',[
            'only'=>['store']
        ]);
    }
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
            if(Auth::user()->activated)
            {
                session()->flash('success','欢迎回来');
                $fallback=route('users.show',[Auth::user()]);
                return redirect()->intended($fallback);
            }
            else
            {
                Auth::logout();
                session()->flash('warning','账号未激活，请激活账号');
                return redirect('/');
            }
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
