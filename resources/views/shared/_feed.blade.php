@if($feed_item->count()>0)
    <ul class="list-unstyled">
        @foreach($feed_item as $status)
            @include('status._statuses',['user'=>$status->user])
        @endforeach
    </ul>
    <div class="mt-5">
        {!! $feed_item->render() !!}
    </div>
    @else
    <p>没有数据</p>
@endif
