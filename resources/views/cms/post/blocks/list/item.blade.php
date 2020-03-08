<tr>
    <th scope="row">{{ $post->id }}</th>
    <td>{{ link_to(route('cms.posts.show', ['post' => $post->id, 'locale' => \App::getLocale()]), $post->name) }}</td>
    <td>{{ $post->is_published ? __('cms.yes') : __('cms.no') }}</td>
    <td>{!! $post->rubrics->pluck('name')->join('<br>') !!}</td>
    <td style="width: 10%">{{ $post->slug }}</td>
    <td>{{$post->created_at->format('d.m.Y H:m:i')}}</td>
</tr>