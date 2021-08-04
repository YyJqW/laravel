<div class="card" id="commentCard">
    @if(count($comments)>0)
        @for($i=0;$i<count($comments);$i++)
        <div class='card-body text-right border' style='font-size: 20px'>
            <p>
                {{$comments[$i]->content}}
            </p>
            <p>
                {{$names[$i]->name}}
            </p>
        </div>
        @endfor
    @endif
</div>
