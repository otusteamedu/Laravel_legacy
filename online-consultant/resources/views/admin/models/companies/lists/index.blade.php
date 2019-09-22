@if(count($companies) > 0)
    <table class="table table-striped table-bordered table-model-index">
        <thead>
            <tr>
                <th>{{ __('admin.companies.fields.name') }}</th>
                <th>{{ __('E-Mail') }}</th>
                <th>{{ __('Url') }}</th>
                <th>{{ __('Created at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php /** @var \App\Models\Company $company */ @endphp
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name_link }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->url }}</td>
                    <td class="column-date-created">{{ $company->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="column-single-controls">
                        @include('admin.models.companies.controls.index.single')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $companies->links() }}
@else
    <p>{{ __('No companies') }}</p>
@endempty
