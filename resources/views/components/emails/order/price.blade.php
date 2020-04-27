<table class="spacer">
    <tbody>
    <tr>
        <td height="24px" style="font-size:24px;line-height:24px;">&#xA0;</td>
    </tr>
    </tbody>
</table>
<table class="row">
    <tbody>
    <tr>
        <th class="small-8 large-6 columns first">
            <table>
                <tr>
                    <th>
                        <h3 class="muted">ЦЕНА ЗАКАЗА</h3>
                    </th>
                </tr>
            </table>
        </th>
        <th class="small-4 large-6 columns last">
            <h3 class="text-right">{{ number_format($totalPrice - $deliveryPrice, 0, '.', ' ') }} ₽</h3>
        </th>
    </tr>
    </tbody>
</table>
<table class="row">
    <tbody>
    <tr>
        <th class="small-8 large-6 columns first">
            <table>
                <tr>
                    <th>
                        <h3 class="muted">ЦЕНА ДОСТАВКИ</h3>
                    </th>
                </tr>
            </table>
        </th>
        <th class="small-4 large-6 columns last">
            <h3 class="text-right">{{ number_format($deliveryPrice, 0, '.', ' ') }} ₽</h3>
        </th>
        <th class="expander"></th>
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
<table class="spacer">
    <tbody>
        <tr>
            <td height="24px" style="font-size:24px;line-height:24px;">&#xA0;</td>
        </tr>
    </tbody>
</table>
<table class="row">
    <tbody>
        <tr>
            <th class="small-8 large-6 columns first">
                <table>
                    <tr>
                        <th>
                            <h2>ИТОГО</h2>
                        </th>
                    </tr>
                </table>
            </th>
            <th class="small-4 large-6 columns last">
                <h2 class="price text-right">{{ number_format($totalPrice, 0, '.', ' ') }} ₽</h2>
            </th>
        </tr>
    </tbody>
</table>
