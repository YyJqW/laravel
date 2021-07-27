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
        Mail::send('email.sendResetLink',compact('token'),function ($message) use ($email){
            $message->to($email)->subject('忘记密码');
        });
        session()->flash('success','重置邮件发送成功，请检查你的邮箱');
        return redirect()->back();
    }
}
