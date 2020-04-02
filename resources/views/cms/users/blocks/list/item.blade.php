<?php
/** @var \App\Models\User $user */
/** @var \App\Models\Tariff $segment */
/** @var \App\Models\Segment $tariff */
?>
<tr>
    <th scope="row">{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->id) }}</th>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->name) }}</th>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->email) }}</td>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->phone) }}</td>
</tr>
