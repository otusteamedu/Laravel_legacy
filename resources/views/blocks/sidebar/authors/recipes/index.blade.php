<div class="list-group">
    <a class="list-group-item list-group-item-action active"
       href="{{route('cms.author.recipes.index','sasha')}}">
        {{__('navs.recipes.my')}}
    </a>
    <a class="list-group-item list-group-item-action"
       href="{{route('cms.author.recipes.favorites.index','sasha')}}">
        {{__('navs.recipes.favorites')}}
    </a>
    <a class="list-group-item list-group-item-action"
       href="{{route('cms.author.recipes.create','sasha')}}">
        {{__('navs.recipes.add')}}
    </a>
</div>
