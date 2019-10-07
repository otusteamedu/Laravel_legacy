@include('admin.roles.blocks.form.errors')

{{ Form::model($role, ['url' => route('admin.roles.update', ['role' => $role]) ])}}
{{ method_field('PUT') }}
    @include('admin.roles.blocks.form.fields')

    @if(!$permissions->isEmpty())
        <table>
        @foreach($permissions as $permission)
            <tr>
                <td>
                    @if($role->hasPermission($permission->name))
                        <input checked name="permissions[]"  type="checkbox" value="{{  $permission->id}}">
                    @else
                        <input name="permissions[]"  type="checkbox" value="{{$permission->id }}">
                    @endif
                </td>
                <td></td>
            <td>{{ $permission->name }}</td>
            </tr>
        @endforeach
        </table>
    @endif





    <div class="form-group">
        {{ Form::submit(trans('roles.save'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}