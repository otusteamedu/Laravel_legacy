<?php /** @var \App\Models\User $user */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->id) }}</th>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->name) }}</th>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->email) }}</td>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->phone) }}</th>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->tariff_id) }}</td>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->segment_id) }}</th>
</tr>
