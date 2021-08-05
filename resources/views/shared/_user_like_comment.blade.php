@if(Auth::check())
    @if(Auth::user()->liked_comment($ids[$i]->id))
        <button class="btn btn-light" onclick="urlsend_comment({{$ids[$i]->id}})">
            <i id="button_comment{{$ids[$i]->id}}" class="bi bi-hand-thumbs-up-fill"></i>
        </button>
    @else
        <button class="btn btn-light" onclick="urlsend_comment({{$ids[$i]->id}})">
            <i id="button_comment{{$ids[$i]->id}}" class="bi bi-hand-thumbs-up"></i>
        </button>
    @endif
@endif
