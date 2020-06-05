<?php
/** @var \App\Models\User $item */
?>
<tr>
    <td class="text-center">{{ $item->id }}</td>
    <td>{{ link_to(route('staffs.show', ['staff' => $item->id]), $item->name) }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->group->name }}</td>
    <td>
        <a href="{{ route('staffs.edit', ['staff' => $item->id]) }}" class="btn btn-primary btn-sm">
            @materialicon('content', 'create', 'white')
        </a>
        {{ Form::open(['route' => ['staffs.show', 'staff' => $item->id], 'method' => 'delete', 'class' => 'd-inline-block'])}}
            <button type="submit" class="btn btn-danger btn-sm">@materialicon('action', 'delete', 'white')</button>
        {{ Form::close() }}
    </td>
</tr>
