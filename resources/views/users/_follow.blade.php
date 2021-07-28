@can('follow',$user)
    <div class="text-center mt-2 mb-4">
        @if(Auth::user()->isFollowing($user->id))
            <form action="{{route('follow.destroy',$user)}}" method="post">
                @csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-sm btn-outline-primary">取消关注</button>
            </form>
        @else
            <form action="{{route('follow.store',$user)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary">关注</button>
            </form>
        @endif
    </div>
@endcan
