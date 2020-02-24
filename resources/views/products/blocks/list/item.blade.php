<tr>
    <th scope="row">{{ $product['id'] }}</th>
    <th>{{ $product['title'] }}</th>
    <td>@money($product['price'])</td>
    <td>{{ trans_choice('messages.remainingOfTotal', $product['remainingCount'], ['remaining' => $product['remainingCount'], 'total' =>$product['totalCount']]) }}</td>
    <td>@date($product['created_at'])</td>
</tr>

@date($product['created_at'])
