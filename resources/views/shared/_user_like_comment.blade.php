@if(Auth::check())
    <button class="btn btn-light position-relative" onclick="urlsend_comment({{$comment->id}})">
        @if(Auth::user()->liked_comment($comment->id))
            <i id="button_comment{{$comment->id}}" class="bi bi-hand-thumbs-up-fill"></i>
        @else
            <i id="button_comment{{$comment->id}}" class="bi bi-hand-thumbs-up"></i>
        @endif
        @if($comment->liked_count()->getData()->count>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-light" id="commentBadge{{$comment->id}}">
                 {{$comment->liked_count()->getData()->count}}
            </span>
        @endif
    </button>
@endif
