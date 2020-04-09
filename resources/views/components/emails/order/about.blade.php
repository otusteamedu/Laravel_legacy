<tr style="border-collapse:collapse;">
    <td align="left" bgcolor="#fafafa" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;background-color:#FAFAFA;">
    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
        <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
            <tr style="border-collapse:collapse;">
                <td width="269" class="es-m-p20b" align="left" style="padding:0;Margin:0;">
                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="transparent" role="presentation">
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;padding-bottom:10px;">
                                <div style="font-size:20px;color:#3399ff;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;">
                                    О ЗАКАЗЕ:
                                </div>
                            </td>
                        </tr>
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;">
                                <table border="0" cellspacing="1" cellpadding="1" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" role="presentation">
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">Номер:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                            {{ $number }}
                                        </td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">Дата:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                            {{ $date }}
                                        </td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">Статус:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                            {{ $status->title }}
                                        </td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">Доставка:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                            {{ $delivery['title'] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
        <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;">
            <tr style="border-collapse:collapse;">
                <td width="271" align="left" style="padding:0;Margin:0;">
                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="transparent" role="presentation">
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;padding-bottom:10px;">
                                <div style="font-size:20px;color:#3399ff;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;">
                                    О ДОСТАВКЕ:
                                </div>
                            </td>
                        </tr>
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;">
                                <table border="0" cellspacing="1" cellpadding="1" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" role="presentation">
                                    @if($delivery['alias'] === 'tc_cdek' || $delivery['alias'] === 'courier_cdek')
                                        <tr style="border-collapse:collapse;">
                                            <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                                {{ $delivery['locality']['countryName'] }}
                                            </td>
                                        </tr>
                                        <tr style="border-collapse:collapse;">
                                            <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                                {{ $delivery['locality']['regionName'] }}, {{ $delivery['locality']['cityName']  }}
                                            </td>
                                        </tr>
                                        @if(isset($delivery['pvz']))
                                            <tr style="border-collapse:collapse;">
                                                <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                                    {{ $delivery['pvz']['address'] }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="border-collapse:collapse;">
                                                <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                                    {{ $delivery['street'] }}, {{ $delivery['apartments'] }}
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif($delivery['alias'] === 'pickup')
                                        <tr style="border-collapse:collapse;">
                                            <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                                {{ $delivery['pickup'] }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;font-size:16px;color:#333333;">
                                            {{ $customer['secondName'] }} {{ $customer['firstName'] }} {{ $customer['middleName'] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td></tr></table><![endif]-->
    </td>
</tr>
