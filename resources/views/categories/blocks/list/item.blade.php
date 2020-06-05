@php($pageLocale = app()->getLocale())
<tr>
    <td scope="row">{{ link_to(route('cms.categories.show', ['category' => $category['id']]), $category['id']) }}</td>
    <td>{{ $category->data[$pageLocale]['name'] }}</td>
    <td>{{ $category->created_at }}</td>
</tr>
