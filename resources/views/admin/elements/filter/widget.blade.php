@isset($items)
<div class="filter-block">
    <form action="{{ $action }}" method="get">
        <input type="hidden" name="filter_set" value="Y" />
        <table>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td><label for="{{ $prefix }}{{ $item['name'] }}">{{ $item['title'] }}</label></td>
                    <td>{!! $item['html'] !!}</td>
                </tr>
                @endforeach
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="@lang('admin.filter.submit')"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endisset
