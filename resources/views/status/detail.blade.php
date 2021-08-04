@extends('layout.default')
@section('title', '微博详情')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>
                {{$status->user->name}}
            </h3>
        </div>
        <div class="card-body">
            <p style="font-size:20px">
                {{ $status->content }}
            </p>
        </div>
    </div>
    <script>addComment({{$status->id}},"{{Auth::user()->name}}")</script>
    @include('shared._comment')
    <div class="input-group mb-3">
        <input type="text" class="form-control-lg" placeholder="说点啥" aria-label="Recipient's username" aria-describedby="button-addon2" id="comment">
        <button class="btn btn-outline-secondary" type="button" id="commentSubmit">评论</button>
    </div>
@stop
