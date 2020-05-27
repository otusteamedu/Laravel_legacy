<?php
/**
 * @var \App\Models\Article $article
 */
?>

<div class="col-md-8 blog-main rounded box-shadow bg-white pt-3">
    <div class="article">
        <h2 class="article-title">{{$article->title}}</h2>
        <p class="article-meta">{{$article->published_at}} Автор:<a
                href="{{route('userInfo', ['id'=>$article->user_id])}}"> {{$article->user->name}}</a></p>
        <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x200?theme=thumb" alt="Thumbnail"
             src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171fa80bed9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171fa80bed9%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
             data-holder-rendered="true" style="width: 100%; height: 200px;">
        <br>
        <p>{{$article->full_text}}</p>
    </div>
</div>

