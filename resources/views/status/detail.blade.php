@extends('layout.default')
@section('title', '微博详情')
@section('content')
    <div>
        {{ $status->content }}
    </div>
@stop
