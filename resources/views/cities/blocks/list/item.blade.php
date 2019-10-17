<tr>
    <th scope="row">{{ link_to(App\Helpers\RouteBuilder::localeRoute('cms.countries.show', ['country' => $country['id']]), $country['id']) }}</th>
    <th>{{ link_to(App\Helpers\RouteBuilder::localeRoute('cms.countries.show', ['country' => $country->id]), $country['name']) }}</th>
    <td>@date($country['created_at'])</td>
</tr>