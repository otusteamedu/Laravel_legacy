<?php
/** @var \App\Models\User $item */
?>
<tr>
    <td class="text-center">{{ $item->id }}</td>
    <td>
        @can('client.view', $item)
            {{ link_to(route('clients.show', ['client' => $item->id]), $item->name) }}
        @else
            {{ $item->name }}
        @endcan
    </td>
    <td>{{ $item->email }}</td>
    <td>@moneyFormat($item->balance)</td>
    <td>
        @can('client.update', $item)
        <a href="{{ route('clients.edit', ['client' => $item->id]) }}" class="btn btn-primary btn-sm">
            @materialicon('content', 'create', 'white')
        </a>
        @endcan
        @can('client.delete', $item)
        {{ Form::open(['route' => ['clients.show', 'client' => $item->id], 'method' => 'delete', 'class' => 'd-inline-block'])}}
            <button type="submit" class="btn btn-danger btn-sm">@materialicon('action', 'delete', 'white')</button>
        {{ Form::close() }}
        @endcan
    </td>
</tr>
