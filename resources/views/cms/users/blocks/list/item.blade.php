<?php /** @var \App\Models\User $user */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->id) }}</th>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->name) }}</th>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->email) }}</td>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->phone) }}</td>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $country = App\Models\Tariff::find(1)->name) }}</td>
    <td>{{ link_to(route('cms.users.show', ['user' => $user->id]), $country = App\Models\Segment::find(1)->name) }}</td>
</tr>
