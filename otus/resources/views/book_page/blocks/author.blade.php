@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="downloadBook__author">
    @foreach($material->authors as $author)
        @if(isset($author))
            {{$author->name}}
                @if(!$loop->last)
                    ,
                @endif
        @endif
    @endforeach
    {{$material->year_publishing}}
</div>
