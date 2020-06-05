<?php
/** @var \App\Models\Project $item */
?>
<tr>
    <td class="text-center">{{ $item->id }}</td>
    <td>{{ link_to(route('projects.show', ['project' => $item->id]), $item->name) }}</td>
    <td>
        <a href="{{ route('projects.edit', ['project' => $item->id]) }}" class="btn btn-primary btn-sm">
            @materialicon('content', 'create', 'white')
        </a>
        {{ Form::open(['route' => ['projects.show', 'project' => $item->id], 'method' => 'delete', 'class' => 'd-inline-block'])}}
            <button type="submit" class="btn btn-danger btn-sm">@materialicon('action', 'delete', 'white')</button>
        {{ Form::close() }}
    </td>
</tr>
