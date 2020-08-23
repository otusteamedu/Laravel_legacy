<!-- Навбар со списком категорий -->
<div class="nav-scroller py-1 mb-2 border-bottom bg-white">
    <nav class="nav d-flex justify-content-between">
        @foreach($categories as $categoryId => $categoryTitle)
            <a class="p-2 text-muted" href="{{route('category', ['category' => $categoryId])}}">{{ $categoryTitle }}</a>
        @endforeach
    </nav>
</div>
