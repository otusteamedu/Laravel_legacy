@php /** @var \App\Models\Material $material */
$materialCollection = \App\Models\Material::all();
$material = $materialCollection->get(0);
@endphp
<div class="infoBook">
    <div class="infoBook__wrapStatus">
        <div class="infoBook__avatar">
            <img class="infoBook__imgAvatar" src="#" alt="" role="presentation"/>
        </div>
        <div class="infoBook__status">{{$material->status->name}}</div>
    </div>
    <button class="infoBook__interactionBook">@lang('messages.take_paper_version')</button>
</div>
