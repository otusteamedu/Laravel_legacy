@if(count($users) > 0)
    <table class="table table-striped table-bordered table-model-index">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('E-Mail') }}</th>
                <th>{{ __('admin.companies.model.single_name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php /** @var \App\Models\User $user */ @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name_link }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->company_name_link }}</td>
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
