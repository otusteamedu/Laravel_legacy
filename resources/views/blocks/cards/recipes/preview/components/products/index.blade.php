@isset($recipe['products'])
    @if(is_array($recipe['products']))
        @foreach($recipe['products'] as $product)
            @php($params = ['title'=>$product['name'], 'link'=>'slug'])
            @component('blocks.badges.product', $params)@endcomponent
        @endforeach
    @else
        {{$recipe['products']}}
    @endif
@endisset
