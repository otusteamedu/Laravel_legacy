<?php
/**
 * @var \App\Models\User\User $user
 */
?>
<tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id, 'locale' => $locale]), $user->name) }}</td>
    <td style="width: 10%">{{ $user->group->name }}</td>
    <td>{{$user->created_at->format('d.m.Y H:m:i')}}</td>
</tr>