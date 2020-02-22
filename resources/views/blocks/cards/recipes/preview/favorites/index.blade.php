@section('management')
    @component('blocks.cards.recipes.components.management.index')@endcomponent
@endsection

@section('tags')
    @component('blocks.badges.like',['count'=>$recipe['count']['like']])@endcomponent
    @component('blocks.badges.comments',['count'=>$recipe['count']['comments']])@endcomponent
    <span class="ml-auto">
        @include('blocks.cards.recipes.components.author')
    </span>
@endsection

@include('blocks.cards.recipes.preview.components.index')
