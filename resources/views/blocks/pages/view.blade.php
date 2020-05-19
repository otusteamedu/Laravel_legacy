<table class="table table-hover">
    @foreach($items as $name => $item)
        <tr>
            <td>{{$name}}</td>
            <td>{{$item}}</td>
        </tr>
    @endforeach
</table>
<hr>
<a href="#" type="button" class="btn btn-danger">@lang('buttons.edit_button')</a>
<hr>
