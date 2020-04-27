@extends('layouts.emails.default')

@section('title', 'Заказ # ' . $order['number'])

@section('content')
    <x-emails.order.about :number="$order['number']" :date="$order['date']" :status="$order['status']"/>

    <table class="callout">
        <tr>
            <th class="callout-inner primary">
                <table class="row">
                    <tbody>
                        <tr>
                            <th class="small-12 large-12 columns first last">
                                <h2>{{ $order['goodsQty'] }}</h2>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <table class="spacer">
                    <tbody>
                        <tr>
                            <td height="12px" style="font-size:12px;line-height:12px;">&#xA0;</td>
                        </tr>
                    </tbody>
                </table>
                <table class="hr">
                    <tbody>
                        <th></th>
                    </tbody>
                </table>
                @foreach($order['items'] as $item)
                    <x-emails.order.item :item="$item"/>
                @endforeach
                <x-emails.order.price :totalPrice="$order['price']" :deliveryPrice="$order['delivery']['price']"/>
            </th>
            <th class="expander"></th>
        </tr>
    </table>

    <x-emails.order.delivery :delivery="$order['delivery']" :customer="$order['customer']"/>

    @if (!empty($order['comment']))
        <x-emails.order.comment :comment="$order['comment']" />
    @endif
@endsection
