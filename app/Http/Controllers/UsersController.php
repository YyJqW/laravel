<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Mail;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
                'except'=>['show','create','store','index','confirm']
            ]
        );
        $this->middleware('guest',[
            'only'=>['create']
        ]);
        $this->middleware('throttle:10,10',[
            'only'=>['store']
        ]);
    }
    public function confirm($token)
    {
        $user = User::where('activation_token',$token)->firstOrFail();
        $user->activated=true;
        $user->activation_token=null;
        $user->save();
        Auth::login($user);
        session()->flash('success','欢迎，认证成功');
        return redirect()->route('users.show',$user);
    }
    public function create()
    {
        return view('users.create');
    }
    public function show(User $user)
    {
        $statuses=$user->statuses()->orderBy('created_at','desc')->paginate(30);
        return view('users.show',compact('user','statuses'));
    }
    public function  store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        $this->sendEmail($user);
        session()->flash('success','注册成功，验证邮件已经发到你的邮箱，请确认');
        return redirect('/');
    }
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }
    public function update(User $user,Request $request)
    {
        $this->authorize('update',$user);
        $this->validate($request,[
            'name'=>'required|max:50',
            'password'=>'nullable|confirmed|min:6'
        ]);
        $data=[];
        $data['name']=$request->name;
        if ($request->password)
        {
            $data['password']=bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success','用户信息更新成功');
        return view('users.show',compact('user'));
    }
    public function index()
    {
        $users = User::paginate(6);
        return view('users.index',compact('users'));
    }
    public function destroy(User $user)
    {
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success','删除成功');
        return back();
    }
    protected function sendEmail($user)
    {
        $view='email.confirm';
        $data=compact('user');
        $to=$user->email;
        $subject='感谢注册，请确认你的邮箱';
        Mail::send($view,$data,function ($message) use ($to,$subject){
            $message->to($to)->subject($subject);
        });
    }
    public function following(User $user)
    {
        $users=$user->following()->paginate(30);
        $title=$user->name."关注的人";
        return view('users.show_follow',compact('users','title'));
    }
    public function fans(User $user)
    {
        $users=$user->fans()->paginate(30);
        $title=$user->name."的粉丝";
        return view('users.show_follow',compact('users','title'));
    }
}
