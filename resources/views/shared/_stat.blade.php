<a href="#">
    <strong id="following" class="stat">
        {{count($user->following)}}
    </strong>
    关注
</a>
<a href="#">
    <strong id="fans" class="stat">
        {{count($user->fans)}}
    </strong>
    粉丝
</a>
<a href="#">
    <strong id="fans" class="stat">
        {{$user->statuses()->count()}}
    </strong>
    微博
</a>
