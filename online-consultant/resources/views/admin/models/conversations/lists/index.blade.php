@if(count($conversations) > 0)
    <table class="table table-striped table-bordered table-model-index">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('admin.leads.model.single_name') }}</th>
                <th>{{ __('admin.widgets.model.single_name') }}</th>
                <th>{{ __('admin.users.model.single_name') }}</th>
                <th>{{ __('admin.companies.model.single_name') }}</th>
                <th>{{ __('admin.conversations.fields.created_user') }}</th>
                <th>{{ __('admin.tables.columns.created_at') }}</th>
                <th>{{ __('admin.tables.columns.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @php /** @var \App\Models\Conversation $conversation */ @endphp
            @foreach($conversations as $conversation)
                <tr>
                    <td>{{ $conversation->id }}</td>
                    <td>{{ $conversation->lead_name_link }}</td>
                    <td>{{ $conversation->widget_domain_link }}</td>
                    <td>{{ $conversation->manager_name_link }}</td>
                    <td>{{ $conversation->company_name_link }}</td>
                    <td>{{ $conversation->createdUser->name_link }}</td>
                    <td class="column-date-created">{{ $conversation->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="column-single-controls">
                        @include('admin.models.conversations.controls.index.single')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $conversations->links() }}
@else
    <p>{{ __('No conversations') }}</p>
@endempty
