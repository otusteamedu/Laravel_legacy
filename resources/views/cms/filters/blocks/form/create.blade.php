{!! Form::open(['action' => 'Cms\Filters\FiltersController@store']) !!}
{{--{!! Form::open(['route' => 'cms.filters.store']) !!}--}}
    @include('cms.filters.blocks.form.blocks.fields')
{!! Form::submit(__('cms.update'), ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
