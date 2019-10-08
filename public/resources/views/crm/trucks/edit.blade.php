@extends($layout)

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h3 style="margin-top:50px;">
            <span>Редактировать</span>
        </h3>
        <div>
            {{ Form::model($model, ['url' => route('crm.trucks.update', ['truck' => $model]), 'method' => 'PATCH']) }}
            @include('crm.trucks.blocks.fields')
            {{ Form::close() }}
        </div>
    </main>
@endsection
