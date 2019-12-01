@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="downloadBook__titleAndTags">
    <div class="downloadBook__title">{{$material->name}}</div>
    <div class="downloadBook__wrapTags">
        <div class="downloadBook__itemTag ">{{$material->type}}</div>
    </div>
</div>
