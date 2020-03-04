<div class="card">
    <div class="card-header d-flex justify-content-between">
        <a href="{{route('cms.authors.show', $comment['user']['slug'])}}">
            <img class="rounded-circle" src="{{$comment['user']['photo']}}" alt="" style="width: 30px; height: 30px">
            <span>{{$comment['user']['name']}}</span>
        </a>
        <span>{{$comment['date']}}</span>
    </div>
    <div class="card-body">
        <p>{{$comment['text']}}</p>
    </div>
</div>
