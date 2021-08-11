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
                <div>
                    <button class="btn btn-light position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$comment->id}}" aria-expanded="false" aria-controls="collapse{{$comment->id}}">
                        评论
                        @if(count($comment->findSon())>0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" id="commentSonBadge{{$comment->id}}">
                                <a style="opacity: 0">a</a>
                            </span>
                        @endif
                    </button>
                    @include('shared._user_like_comment')
                </div>
                <div class="collapse" id="collapse{{$comment->id}}">
                    <div class="card card-body" id="sonCommentCard{{$comment->id}}">
                        @if(count($comment->findSon())>0)
                            @foreach($comment->findSon() as $son)
                                <div class="card-body border">
                                    <p>
                                        {{$son->user->name}}:{{$son->content}}
                                        <button class="btn btn-light" id="sonCommentSubmit{{$son->id}}"
                                                onclick="$('#sonComment{{$comment->id}}').val('回复 {{$son->user->name}}：')">
                                            回复
                                        </button>
                                    </p>
                                </div>
                            @endforeach
                        @endif
                        <textarea class="form-control" id="sonComment{{$comment->id}}"></textarea>
                        <div>
                            <script>addSonComment({{$comment->id}},"{{Auth::user()->name}}")</script>
{{--                            {{dd($comment->findSon())}}--}}
                            <button class="btn btn-light" id="sonCommentSubmit{{$comment->id}}">回复</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
