<?php /** @var \App\Models\Filter $filter */ ?>
<tr class="align-middle">
    <td scope="row">{{ link_to(route('cms.filters.edit', ['filter' => $filter->id]), $filter->id) }}</td>
    <td> {{ $filter->filter_type_id }} </td>
    <td> {{ $filter->quota_id }} </td>
    <td  class="align-middle">{{ link_to(route('cms.filters.edit', ['filter' => $filter->id]), $filter->name) }}</td>
{{--    <td> {{ $filter->name }} </td>--}}
    <td> {{ $filter->value }} </td>
    <td> {{ $filter->description }} </td>
    <td> @date( $filter->created_at ) </td>
    <td> @date( $filter['updated_at'] ) </td>
    <td> @date( $filter['deleted_at'] ) </td>
    <td>
        {!! Form::open(['url' => route('cms.filters.destroy',  $filter->id), 'method' => 'delete', 'class' => 'm-0']) !!}
        <button class='btn btn-danger table-buttons' type='submit' value='submit'><i class='fas fa-trash'></i></button>
        {!! Form::close() !!}
    </td>
</tr>
