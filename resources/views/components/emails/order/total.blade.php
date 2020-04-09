<tr style="border-collapse:collapse;">
    <td align="left" bgcolor="#ffffff" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;background-color:#FFFFFF;">
        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
            <tr style="border-collapse:collapse;">
                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;">
                                <table border="0" cellspacing="2" cellpadding="1" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px;" class="cke_show_border" role="presentation">
                                    <tr height="25px" style="border-collapse:collapse;">
                                        <td width="120px" style="padding:0;Margin:0;font-size:20px;color:#333333;">
                                            <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333;">Цена:</h3>
                                        </td>
                                        <td style="padding:0;Margin:0;font-size:20px;color:#333333;">
                                            <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333;">
                                                {{ $price }} ₽
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr height="25px" style="border-collapse:collapse;">
                                        <td width="120px" style="padding:0;Margin:0;font-size:20px;color:#333333;">
                                            <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333;">Доставка:</h3>
                                        </td>
                                        <td style="padding:0;Margin:0;font-size:20px;color:#333333;">
                                            <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333;">
                                                {{ $deliveryPrice ? $deliveryPrice : 0 }} ₽
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr height="25px" style="border-collapse:collapse;">
                                        <td width="120px" style="padding:0;Margin:0;font-size:24px;color:#333333;">
                                            <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333;">Итого:</h1>
                                        </td>
                                        <td style="padding:0;Margin:0;font-size:24px;color:#3399FF;">
                                            <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#3399FF;">
                                                {{ $price + $deliveryPrice }} ₽
                                            </h1>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
