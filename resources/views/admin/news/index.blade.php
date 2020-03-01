<div class="row justify-content-between">
<div class="col-lg-6">
    <div class="col-6 mb-3">
        <a href="{{ route('admin.news.create') }}" class="btn btn-outline-dark">Добавить</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-lg-8">Название</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($news as $oneNews)
            @php /** @var \App\Models\News $oneNews */ @endphp
            <tr>
                <td>{{ $oneNews->title }}</td>
            <td class="col-lg-1"><a href="{{ route('admin.news.edit', $oneNews->id) }}" class="color-edit"><span data-feather="edit"></span></a></td>
                <td class="col-lg-1"><a href="#" class="color-del"><span data-feather="x-octagon"></span></a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @if ($news->total() > $news->count())
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{ $news->links() }}
            </div>
        </div>
    @endif
</div>

</div>