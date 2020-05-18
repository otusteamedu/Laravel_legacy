<?php /** @var \App\Models\Product $product */ ?>
<tr>
    <th scope="row">{{ $product->id }}</th>
    <th>{{ $product->name }}</th>
    <th>{{ $product->company->city->name }} ({{ $product->company->city->country->name }})</th>
    <td>@money($product->price)</td>
    <td>{{ trans_choice('messages.remainingOfTotal', $product->remaining_count, ['remaining' => $product->remaining_count, 'total' =>$product->total_count]) }}</td>
    <td>@date($product->created_at)</td>
</tr>
