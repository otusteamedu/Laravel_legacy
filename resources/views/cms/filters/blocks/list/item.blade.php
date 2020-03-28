<?php /** @var \App\Models\Filter $filter */ ?>
<tr>
    <td scope="row">{{ link_to(route('cms.filters.edit', ['filter' => $filter->id]), $filter->id) }}</td>
    <td> {{ $filter->filter_type_id }} </td>
    <td> {{ $filter->quota_id }} </td>
    <td>{{ link_to(route('cms.filters.edit', ['filter' => $filter->id]), $filter->name) }}</td>
{{--    <td> {{ $filter->name }} </td>--}}
    <td> {{ $filter->value }} </td>
    <td> {{ $filter->description }} </td>
    <td> @date( $filter['created_at'] ) </td>
    <td> @date( $filter['updated_at'] ) </td>
</tr>
