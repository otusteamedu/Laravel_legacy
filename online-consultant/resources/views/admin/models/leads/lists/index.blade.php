@if(count($leads) > 0)
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
            @php /** @var \App\Models\Lead $lead */ @endphp
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->name_link }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->company_name_link }}</td>
                    <td class="column-date-created">{{ $lead->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="column-single-controls">
                        @include('admin.models.leads.controls.index.single')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $leads->links() }}
@else
    <p>{{ __('No leads') }}</p>
@endif
