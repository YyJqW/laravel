@extends('layout.default')
@section('title', '登录')
@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card">
        <div class="card-header">
            <h5>登录</h5>
        </div>
        <div class="card-body">
            @include('shared._erro')
            <form method="post" action="{{route('login')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="email">
                        邮箱：
                    </label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">
                        密码：
                    </label>
                    <input type="password" name="password" class="form-control" value="{{old('password')}}">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="check1">
                        <label for="check1" class="form-check-label">记住我</label>
                    </div>
                    <a href="{{route('pwd.request')}}">忘记密码？</a>
                </div>
                <button type="submit" class="btn btn-primary">登录</button>
            </form>
            <hr>
            <p>没有账号？<a href="{{route('signup')}}">现在注册</a></p>
        </div>
    </div>
</div>
    @stop
