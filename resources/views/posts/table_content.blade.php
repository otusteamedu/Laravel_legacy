<thead>
<tr>
    @foreach($content['titles'] as $title)
        <th>{{$title}}</th>
    @endforeach
</tr>
</thead>
<tbody>
@php/** @var \App\Models\Post $item */@endphp
@foreach($content['items'] as $item)
    <tr>
        <td><a href="{{ route('posts.show', $item->id) }}">{{$item->id}}</a></td>
        <td><a href="{{ route('posts.show', $item->id) }}">{{$item->title}}</a></td>
        <td>{{$item->groups->pluck('number')}}</td>
        <td>{{$item->published_at}}</td>
    </tr>
@endforeach
</tbody>
