<div class="row justify-content-between">
<div class="col-lg-6">
    <div class="col-6 mb-3">
        <a href="{{ route('admin.category.create') }}" class="btn btn-outline-dark">Добавить</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-lg-8">Название</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($category as $onecategory)
            @php /** @var \App\Models\category $onecategory */ @endphp
            <tr>
                <td>{{ $onecategory->title }}</td>
            <td class="col-lg-1"><a href="{{ route('admin.category.edit', $onecategory->id) }}" class="color-edit"><span data-feather="edit"></span></a></td>
                <td class="col-lg-1"><a href="#" class="color-del"><span data-feather="x-octagon"></span></a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $category->links() }}
</div>

</div>