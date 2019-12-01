@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="downloadBook__category">{{$material->category->name}}</div>
