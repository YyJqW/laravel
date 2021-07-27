<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Str;
use DB;
use Mail;
use Carbon\Carbon;

class pwdController extends Controller
{
    public function requestForm()
    {
        return view('auth.pwd.FormPage');
    }
    public function sendLink(Request $request)
    {
        $request->validate(['email:required|email']);
        $email=$request->email;
        $user = User::where('email',$email)->first();
        if(is_null($user))
        {
            session()->flash('danger','邮箱不存在');
            return redirect()->back()->withInput();
        }
        $token=hash_hmac('sha256',Str::random(40),config('app.key'));
        DB::table('password_resets')->updateOrInsert(['email'=>$email],[
            'email'=>$email,
            'token'=>Hash::make($token),
            'created_at'=>new Carbon
        ]);
        Mail::send('email.sendResetLink',compact('token','email'),function ($message) use ($email){
            $message->to($email)->subject('忘记密码');
        });
        session()->flash('success','重置邮件发送成功，请检查你的邮箱');
        return redirect()->back();
    }
    public function resetForm(Request $request)
    {
        $token=$request->route()->parameter('token');
        $email=$request->route()->parameter('email');
        return view('auth.pwd.ResetPage',compact('token','email'));
    }
    public function reset(Request $request)
    {
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed|min:8'
        ]);
        $email=$request->email;
        $token=$request->token;
        $expires=60*10;
        $user=User::where('email',$email)->first();
        $record=(array) DB::table('password_resets')->where('email',$email)->first();
        if ($record)
        {
            if(Carbon::parse($record['created_at'])->addSecond($expires)->isPast())
            {
                session()->flash('danger','链接已过期，请重试');
                return redirect()->back();
            }
            if(!Hash::check($token,$record['token']))
            {
                session()->flash('danger','令牌错误');
                return redirect()->back();
            }
            $user->update(['password'=>bcrypt($request->password)]);
            session()->flash('success','重置成功，请重新登录');
            return  redirect()->route('login');
        }
        session()->flash('danger','重置记录不存在');
        return redirect()->back();
    }
}
