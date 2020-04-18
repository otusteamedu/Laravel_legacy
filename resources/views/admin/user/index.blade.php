<div class="row justify-content-between">
<div class="col-lg-7">
{{--     <div class="col-6 mb-3">
        <a href="{{ route('admin.user.create') }}" class="btn btn-outline-dark">Добавить</a>
    </div> --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-lg-8">Список пользователей</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user as $oneUser)
            @php /** @var \App\Models\User $oneNews */ @endphp
            <tr>
                <td>{{ $oneUser->name }} ({{ $oneUser->email }})</td>
                <td class="col-lg-1"><a href="{{ route('admin.user.edit', ['user'=>$oneUser]) }}" class="color-edit"><span data-feather="edit"></span></a></td>
                @can(App\Policies\Abilities::DELETE, App\User::class)
                <td class="col-lg-1">
                    {{ Form::model($user, ['url' => route('admin.user.destroy', ['user' => $oneUser]), 'method' => 'DELETE']) }}
                        {{ Form::button('<span data-feather="x-octagon"></span>',array_merge(['class' => 'color-del', 'type'=>'submit'])) }}
                    {{ Form::close() }}
                </td>
                @endcan
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $user->links() }}
</div>

</div>