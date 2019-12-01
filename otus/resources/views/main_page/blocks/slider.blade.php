@php /** @var \App\Models\Material $material */
 $materialCollection = \App\Models\Material::all();
@endphp
<div class="bookSlider">
    @foreach($materialCollection as $material)
        @php /** @var \App\Models\Material $material */
            $material->preview_image = 'images/bookBg.jpg';
        @endphp
        <a class="bookSlider__item" href="{{route('admin.materials.show', ['material' => $material])}}">
            <div class="bookSlider__wrapImg">
                <img class="bookSlider__img" src="{{ asset('storage/' . $material->preview_image) }}" alt="" role="presentation" />
            </div>
            <div class="bookSlider__category">{{$material->category->name}}</div>
            <div class="bookSlider__name">{{$material->name}}</div>
        </a>
    @endforeach
</div>
