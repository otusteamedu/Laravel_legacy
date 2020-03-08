<tr>
    <th scope="row">{{ $page->id }}</th>
    <td>{{ link_to(route('cms.pages.show', ['page' => $page->id, 'locale' => \App::getLocale()]), $page->name) }}</td>
    <td style="width: 10%">{{ $page->slug }}</td>
    <td>{{$page->created_at->format('d.m.Y H:m:i')}}</td>
</tr>