<?php
    /** @var \App\Models\User\Group $group */
?>
<tr>
    <th scope="row">{{ $group->id }}</th>
    <td>{{ link_to(route('cms.groups.show', ['group' => $group->id, 'locale' => \App::getLocale()]), $group->name) }}</td>
    <td>{{$group->created_at->format('d.m.Y H:m:i')}}</td>
</tr>