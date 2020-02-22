@section('management')
    @php($params = ['publish' => $recipe['published']])
    @component('blocks.cards.recipes.components.management.authors.index', $params)@endcomponent
@endsection
@include('blocks.cards.recipes.detail.layouts.index')
