<?php
/**
 * @var \App\Models\Category $category
 */
?>
<div class="nav-scroller py-1 mb-2 border-bottom bg-white">
    <nav class="nav d-flex justify-content-between">
        @foreach($categories as $category)
            <a class="p-2 text-muted" href="{{route('category', ['id'=>$category->id])}}">{{$category->title}}</a>
        @endforeach
    </nav>
</div>
