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
            <th class="small-12 large-6 columns first">
                <table>
                    <tr>
                        <th>
                            <img class="small-float-center" src="{{ $item['thumbPath'] }}" width="240" alt="">
                        </th>
                        <th class="show-for-large" width="12px"></th>
                    </tr>
                </table>
            </th>
            <th class="small-12 large-6 columns last">
                <table>
                    <tr>
                        <th class="show-for-large" width="12px"></th>
                        <th>
                            <table class="collapse">
                                <tbody>
                                <tr>
                                    <td class="large-2">
                                        <span class="bold">Артикул:</span>
                                    </td>
                                    <td>
                                        {{ $item['article'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="large-2">
                                        <span class="bold">Размеры:</span>
                                    </td>
                                    <td>
                                        {{ $item['dimensions'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="large-2">
                                        <span class="bold">Материал:</span>
                                    </td>
                                    <td>
                                        {{ $item['texture'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="large-2">
                                        <span class="bold">Эффекты:</span>
                                    </td>
                                    <td>
                                        {{ $item['filter'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="large-2">
                                        <span class="bold">Количество:</span>
                                    </td>
                                    <td>
                                        {{ $item['qty'] }}
                                    </td>
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
                            <h2 class="price">{{ number_format($item['price'], 0, '.', ' ') }} ₽</h2>
                        </th>
                    </tr>
                </table>
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
