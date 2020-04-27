<table class="callout">
    <tr>
        <th class="callout-inner primary">
            <table class="row">
                <tbody>
                <tr>
                    <th class="small-12 large-12 columns first last">
                        <table>
                            <tr>
                                <th>
                                    <h2>ДЕТАЛИ ДОСТАВКИ</h2>
                                </th>
                            </tr>
                        </table>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="24px" style="font-size:24px;line-height:24px;">&#xA0;</td>
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
                        <h3 class="muted">СПОСОБ ДОСТАВКИ</h3>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="12px" style="font-size:12px;line-height:12px;">&#xA0;</td>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                            <tr>
                                <th>{{ $delivery['title'] }}</th>
                            </tr>
                            </tbody>
                        </table>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="24px" style="font-size:24px;line-height:24px;">&#xA0;</td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 class="muted">АДРЕС ДОСТАВКИ</h3>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="12px" style="font-size:12px;line-height:12px;">&#xA0;</td>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                            <tr>
                                <th>{{ $delivery['locality'] }}</th>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                            <tr>
                                <th>{{ $delivery['address'] }}</th>
                            </tr>
                            </tbody>
                        </table>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="24px" style="font-size:24px;line-height:24px;">&#xA0;</td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 class="muted">ПОЛУЧАТЕЛЬ</h3>
                        <table class="spacer">
                            <tbody>
                            <tr>
                                <td height="12px" style="font-size:12px;line-height:12px;">&#xA0;</td>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                            <tr>
                                <th>{{ $customer['name'] }}</th>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                            <tr>
                                <th>{{ phoneFormat($customer['phone'], config('settings.order_phone_formats')) }}</th>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
                </tbody>
            </table>
        </th>
        <th class="expander"></th>
    </tr>
</table>
<table class="spacer">
    <tbody>
    <tr>
        <td height="8px" style="font-size:8px;line-height:8px;">&#xA0;</td>
    </tr>
    </tbody>
</table>
