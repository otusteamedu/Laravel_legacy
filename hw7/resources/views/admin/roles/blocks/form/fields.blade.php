<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', trans('roles.title')) }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    @if(!$permissions->isEmpty())
        <table>
            @foreach($permissions as $permission)
                <tr>
                    <td>
                        @if(isset($role) && $role->hasPermission($permission->name))
                            <input checked name="permissions[]" type="checkbox" value="{{  $permission->id}}">
                        @else
                            <input name="permissions[]" type="checkbox" value="{{$permission->id }}">
                        @endif
                    </td>
                    <td></td>
                    <td>{{ $permission->name }}</td>
                </tr>
            @endforeach
        </table>
    @endif

</div>
