<div class="hash-tags js-tags">
    <div class="hash-tags__item active" data-tag="all">#Все</div>
    @foreach($categories as $category)
        <div class="hash-tags__item" data-tag="{{Str::slug($category->name, '-')}}">{{$category->name}}</div>
    @endforeach
</div>
