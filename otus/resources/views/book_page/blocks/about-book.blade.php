@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="aboutBook">
    <div class="aboutBook__title">@lang('messages.description')</div>
    <div class="aboutBook__text">{{$material->description}}</div>
</div>
