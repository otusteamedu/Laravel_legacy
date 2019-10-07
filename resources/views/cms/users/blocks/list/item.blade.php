<?php /** @var \App\Models\User $user */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->id) }}</th>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->name) }}</th>
    <th>{{ link_to(route('cms.users.show', ['user' => $user->id]), $user->name )}}</th>
    <td>{{ \App\Helpers\Views\Cms\CmsHelpers::translateCMSConfig('users', 'level', $user->level) }}</td>
    <td>{{ $user->api_token }}</td>
</tr>