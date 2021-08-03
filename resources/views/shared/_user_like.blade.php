@if(Auth::check())
@if(Auth::user()->liked($status->id))
    <button class="btn btn-light" onclick="urlsend({{$status->id}})">
        <i id="button{{$status->id}}" class="bi bi-hand-thumbs-up-fill"></i>
    </button>
@else
    <button class="btn btn-light" onclick="urlsend({{$status->id}})">
        <i id="button{{$status->id}}" class="bi bi-hand-thumbs-up"></i>
    </button>
@endif
@endif
