@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="downloadBook__rowDownload">
    <a class="downloadBook__downloadBtn" href="#" download="download">{{$material->format}}
        <span>&nbsp;12mb</span>
    </a>
</div>
