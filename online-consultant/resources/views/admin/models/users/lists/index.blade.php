@if(count($users) > 0)
    <table class="table table-striped table-bordered table-model-index">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('E-Mail') }}</th>
                <th>{{ __('admin.companies.model.single_name') }}</th>
                <th>{{ __('admin.roles.model.single_name') }}</th>
                <th>{{ __('admin.tables.columns.created_at') }}</th>
                <th>{{ __('admin.tables.columns.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @php /** @var \App\Models\User $user */ @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->company_name_link }}</td>
                    <td>
                        @foreach($user->getRoleNames() as $role)
                            <span class="user-role">{{ $role }}</span>
                        @endforeach
                    </td>
                    <td class="column-date-created">{{ $user->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="column-single-controls">
                        @include('admin.models.users.controls.index.single')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $users->links() }}
@else
    <p>{{ __('No users') }}</p>
@endif
