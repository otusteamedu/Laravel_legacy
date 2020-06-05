<?php
/** @var \App\Models\User $item */
?>
<tr>
    <td class="text-center">{{ $item->id }}</td>
    <td>{{ link_to(route('clients.show', ['client' => $item->id]), $item->name) }}</td>
    <td>{{ $item->email }}</td>
    <td>@moneyFormat($item->balance)</td>
    <td>
        <a href="{{ route('clients.edit', ['client' => $item->id]) }}" class="btn btn-primary btn-sm">
            @materialicon('content', 'create', 'white')
        </a>
        {{ Form::open(['route' => ['clients.show', 'client' => $item->id], 'method' => 'delete', 'class' => 'd-inline-block'])}}
            <button type="submit" class="btn btn-danger btn-sm">@materialicon('action', 'delete', 'white')</button>
        {{ Form::close() }}
    </td>
</tr>
