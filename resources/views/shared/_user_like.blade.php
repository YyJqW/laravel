@if(Auth::check())
    <button class="btn btn-light position-relative" onclick="urlsend({{$status->id}})">
        @if(Auth::user()->liked($status->id))
            <i id="button{{$status->id}}" class="bi bi-hand-thumbs-up-fill"></i>
        @else
            <i id="button{{$status->id}}" class="bi bi-hand-thumbs-up"></i>
        @endif
        @if($status->liked_count()->getData()->count>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-light" id="badge{{$status->id}}">
                 {{$status->liked_count()->getData()->count}}
            </span>
        @endif
    </button>
@endif
