<thead>
<tr>
    @foreach($content['titles'] as $title)
        <th>{{$title}}</th>
    @endforeach
</tr>
</thead>
<tbody>
@php/** @var \App\Models\Group $item */@endphp
@foreach($content['items'] as $item)
    <tr>
        <td><a href="{{ route('groups.show', $item->id) }}">{{$item->number}}</a></td>
        @php/** TODO ссылка на список курсов с фильтрацией по номеру курса */@endphp
        <td><a href="#">{{$item->course->number}}</a></td>
    </tr>
@endforeach
</tbody>
