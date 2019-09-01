<tr>
    <th scope="row">{{ $company['id'] }}</th>
    <th>{{ $company['name'] }}</th>
    <th>{{ $company['url'] }}</th>
    <td>@date($company['created_at'])</td>
</tr>