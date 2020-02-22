@section('management')
    @php($params = ['publish' => $recipe['published']])
    @component('blocks.cards.recipes.components.management.authors.index', $params)@endcomponent
@endsection

@section('tags')
    @if($recipe['published'])
        @component('blocks.badges.published')@endcomponent
    @else
        @component('blocks.badges.unpublished')@endcomponent
    @endif
    @component('blocks.badges.like',['count'=>$recipe['count']['like']])@endcomponent
    @component('blocks.badges.comments',['count'=>$recipe['count']['comments']])@endcomponent
@endsection

@include('blocks.cards.recipes.preview.layouts.index')
