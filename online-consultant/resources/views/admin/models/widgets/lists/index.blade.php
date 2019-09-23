@if(count($widgets) > 0)
    <table class="table table-striped table-bordered table-model-index">
        <thead>
            <tr>
                <th>{{ __('Domain') }}</th>
                <th>{{ __('admin.companies.model.single_name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php /** @var \App\Models\Widget $widget */ @endphp
            @foreach($widgets as $widget)
                <tr>
                    <td>{{ $widget->domain_link }}</td>
                    <td>{{ $widget->company_name_link }}</td>
                    <td class="column-date-created">{{ $widget->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="column-single-controls">
                        @include('admin.models.widgets.controls.index.single')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $widgets->links() }}
@else
    <p>{{ __('No widgets') }}</p>
@endif
