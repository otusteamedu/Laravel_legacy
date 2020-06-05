<?php /** @var \App\Models\Product $product */ ?>
@php($pageLocale = app()->getLocale())
<tr>
    <td scope="row">{{ link_to(route('cms.products.show', ['product' => $product->id]), $product->id) }}</td>
    <td>{{ $product->data[$pageLocale]['name'] }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->quantity }}</td>
    <td>{{ $product->created_at }}</td>
</tr>
