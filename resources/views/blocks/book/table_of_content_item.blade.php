<li>{{ $item['title'] }}</li>
@if (count($item['items']) > 0)
    <ul>
        @foreach($item['items'] as $item)
            @include('blocks.book.table_of_content_item', $item)
        @endforeach
    </ul>
@endif
