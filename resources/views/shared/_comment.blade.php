{{--{{dd($comments)}}--}}
<div class="card" id="commentCard">
    @if(count($comments)>0)
        @foreach($comments as $comment)
            <div class='card-body text-right border' style='font-size: 20px' id="comment_{{$comment->id}}">
                <p>
                    {{$comment->content}}
                </p>
                <p>
                    {{$comment->user->name}}
                </p>
                @include('shared._user_like_comment')
            </div>
        @endforeach
    @endif
</div>
