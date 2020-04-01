{!! Form::model($filter, ['url' => route('cms.filters.update', ['filter' => $filter->id]), 'method' => 'PATCH']) !!}
    @include('cms.filters.blocks.form.blocks.fields')
    {!! Form::submit(__('cms.update'), ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
