<?php /** @var \App\Models\Category $category */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.categories.show', ['category' => $category->id]), $category->id) }}</th>
    <th>{{ link_to(route('cms.categories.show', ['category' => $category->id]), $category->name) }}</th>
    <td>{{ link_to(route('cms.categories.show', ['category' => $category->id]), $category->description) }}</td>
</tr>
