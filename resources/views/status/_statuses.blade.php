<li class="media mt-4 mb-4">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar"/>
    </a>
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $user->name }} <small> / {{ $status->created_at->diffForHumans() }}</small></h5>
        {{ $status->content }}
    </div>
    <div>
        @if(!Auth::user()->liked($status->id))
            <a href="{{route('like',$status)}}">
                <button class="btn btn-primary" >
                    <i class="bi bi-hand-thumbs-up"></i>
                </button>
            </a>
        @else
            <a href="{{route('unlike',$status)}}">
                <button class="btn btn-primary" >
                    <i class="bi bi-hand-thumbs-up-fill"></i>
                </button>
            </a>
        @endif
    @can('destroy',$status)
        <form method="post" action="{{route('statuses.destroy',$status->id)}}" onsubmit="return confirm('确定删除本条微博吗？');">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-sm btn-danger">删除</button>
        </form>
    @endcan
    </div>
</li>
