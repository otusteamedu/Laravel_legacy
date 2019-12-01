@php /** @var \App\Models\Compilation $compilation */
 $compilationCollection = \App\Models\Compilation::all();
@endphp
<div class="blockCategoryBook">
    @foreach($compilationCollection as $compilation)
        @php($countMaterials = random_int(1, 10))
        <a class="blockCategoryBook__item" href="{{route('admin.compilations.show', ['compilation' => $compilation])}}">
            <div class="blockCategoryBook__titleCategory">{{$compilation->compilation->name}}</div>
            <div class="blockCategoryBook__countBook">{{$countMaterials}}</div>
        </a>
    @endforeach
</div>
