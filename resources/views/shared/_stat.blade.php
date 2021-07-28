<a href="{{route('following',$user)}}">
    <strong id="following" class="stat">
        {{count($user->following)}}
    </strong>
    关注
</a>
<a href="{{route('fans',$user)}}">
    <strong id="fans" class="stat">
        {{count($user->fans)}}
    </strong>
    粉丝
</a>
<a href="{{route('users.show',$user)}}">
    <strong id="fans" class="stat">
        {{$user->statuses()->count()}}
    </strong>
    微博
</a>
