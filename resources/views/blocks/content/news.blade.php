<?php
/**
 * @var \App\Models\Article $article
 */
?>
<div class="col-md-8 blog-main">
    <div class="news-list">
        @foreach ($articles as $i=>$article)
            @can('canViewPublic', $article)
                <div class="card flex-md-row mb-4 rounded box-shadow h-md-200">
                    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x200?theme=thumb"
                         alt="Thumbnail [200x200]"
                         src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171fa80bed9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171fa80bed9%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                         data-holder-rendered="true" style="width: 200px; height: 200px;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <span>
                            <strong class="d-inline-block mb-2 text-primary">
                                <a class="text-success"
                                   href="{{route('category', ['category'=>$article->category_id])}}">{{$article->category->title}}</a>
                            </strong>
                            @if($article->is_prepublish)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-activity">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            @endif
                        </span>
                        <h3 class="mb-0">
                            <a class="text-dark" href="#">{{$article->title}}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{$article->published_at}}</div>
                        <p class="card-text mb-auto">{{$article->intro_text}}</p>
                        <a href="{{route('article', ['article'=>$article->id])}}">Перейти к чтению</a>
                    </div>
                </div>
            @endcan
        @endforeach
    </div>
    @if($articles->total() > $articles->count())
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="card-body">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

