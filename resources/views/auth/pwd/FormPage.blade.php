@extends('layout.default')
@section('title', '找回密码')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>找回密码</h5>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <form class="" method="post" action="{{route('pwd.post')}}">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('email')?'has-error':''}}">
                        <label for="email" class="form-control-label">邮箱地址：</label>
                        <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}" required>
                        @if($errors->has('email'))
                            <span class="form-text">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            发送密码重置邮件
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
