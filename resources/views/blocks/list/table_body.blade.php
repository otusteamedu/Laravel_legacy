<tbody>
@foreach($items as $item)
    <tr>
        @foreach($headers as $header)
            @php($column = $header['column'])
            <?php
            if (is_array($column)) {
                $value = $item;
                foreach ($column as $col) {
                    if(isset($value[$col])){
                        $value = $value[$col];
                    } else {
                        break;
                    }
                }
            } else {
                $value = $item[$column];
            }
            ?>

            @if(empty($value))
                @continue
            @endif
            <td>{{$value}}</td>

        @endforeach
        @if(!empty($links))
            <td>
                @foreach($links as $link)
                    {{link_to(route('admin.'.$entity_name['m'].'.'.$link, [ $entity_name['s'] => $item['id']]), __('admin.'.$link))}}
                    <br>
                @endforeach
            </td>
        @endif
    </tr>
@endforeach
</tbody>