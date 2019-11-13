@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
$material->preview_image = 'images/bookBg.jpg';
@endphp
<div class="wrapImgBook">
    <img class="wrapImgBook__img" src="{{ asset('storage/' . $material->preview_image) }}" alt="" role="presentation"/>
</div>
