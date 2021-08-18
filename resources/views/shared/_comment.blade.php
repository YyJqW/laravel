{{--{{dd($comments)}}--}}
<script>
    $(document).ready(function ()
    {
        addComment({{$status->id}},"{{Auth::user()->name}}");
    });
    {{--paginationList({{$status->id}});--}}
    // sonPaginationList();
</script>
<div id="static">
    <div class="card" id="commentCard">
        @if($comments)
{{--            {{dd($comments)}}--}}
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
                        <div class="card soncomment" id="sonCommentCard{{$comment->id}}">
                            @if($comment->findSon())
{{--                                {{$comment->findSon()}}--}}
                                @foreach($comment->findSon() as $son)
                                    <div class="card-body">
                                        <p>
                                            {{$son->user->name}}:{{$son->content}}
                                            <button class="btn btn-light" id="sonCommentSubmit{{$son->id}}"
                                                    onclick="$('#sonComment{{$comment->id}}').val('回复 {{$son->user->name}}：')">
                                                回复
                                            </button>
                                        </p>
                                    </div>
                                @endforeach
{{--                                                        {{dd($comment->findSon())}}--}}
                            @endif
                                {{$comment->findSon()->links('vendor.pagination.cpage',['id'=>$comment->id])}}
                        </div>
                        <div>
                            <textarea class="form-control" id="sonComment{{$comment->id}}"></textarea>
                            <button class="btn btn-light" id="sonCommentSubmit{{$comment->id}}">回复</button>
                        </div>
                    </div>
                </div>
                <script>
                    addSonComment({{$comment->id}},"{{Auth::user()->name}}")
                </script>
            @endforeach
{{--            --}}{{--            <nav aria-label="Page navigation example">--}}
{{--            --}}{{--                <ul class="pagination" id="spage">--}}
{{--            --}}{{--                    @for($i=1;$i<=$comments->lastPage();$i++)--}}
{{--            --}}{{--                        <li class="page-item"><a class="page-link" id={{"?spage=".$i}}>{{$i}}</a></li>--}}
{{--            --}}{{--                    @endfor--}}
{{--            --}}{{--                    <script>paginationList()</script>--}}
{{--            --}}{{--                </ul>--}}
{{--            --}}{{--            </nav>--}}
        @endif
    </div>
    {{$comments->links('vendor.pagination.spage')}}
</div>
