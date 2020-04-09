<tr style="border-collapse:collapse;">
    <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-color:#FFFFFF;">
        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
        <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
            <tr style="border-collapse:collapse;">
                <td width="270" class="es-m-p20b" align="left" style="padding:0;Margin:0;">
                    <table cellpadding="0" width="100%" bgcolor="transparent" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" role="presentation">
                        <tr style="border-collapse:collapse;">
                            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;font-size:0px;">
                                <img src="https://manager.npmrundev.ru/image/order-image-thumb/{{ $item['cropWidth'] }}/{{ $item['cropHeight'] }}/{{ $item['x'] }}/{{ $item['y'] }}/{{ $item['filter']['flip'] ? $item['filter']['flip'] : 0 }}/{{ $item['filter']['colorize'] ? $item['filter']['colorize'] : 0 }}/{{ $item['imageName'] }}" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="270">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
        <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;">
            <tr style="border-collapse:collapse;">
                <td width="270" align="left" style="padding:0;Margin:0;">
                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;">
                                <table border="0" cellspacing="1" cellpadding="1" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" role="presentation">
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;color:#999999;font-size:16px;">Артикул:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;">{{ $item['imageArticle'] }}</td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;color:#999999;font-size:16px;">Размеры:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;">{{ $item['width'] }} см × {{ $item['height'] }} см</td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;color:#999999;font-size:16px;">Материал:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;">{{ $item['textureName']}}</td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;color:#999999;font-size:16px;">Эффекты:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;">{{ $item['filterString'] }}</td>
                                    </tr>
                                    <tr style="border-collapse:collapse;">
                                        <td style="padding:0;Margin:0;color:#999999;font-size:16px;">Количество:</td>
                                        <td style="padding:0;Margin:0;font-size:16px;">{{ $item['qty'] }}</td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr style="border-collapse:collapse;">
                            <td align="center" height="10" style="padding:0;Margin:0;"></td>
                        </tr>
                        <tr style="border-collapse:collapse;">
                            <td align="left" style="padding:0;Margin:0;">
                                <h2 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#3399FF;">
                                    {{ $item['price'] }} ₽
                                </h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td></tr></table><![endif]-->
    </td>
</tr>
