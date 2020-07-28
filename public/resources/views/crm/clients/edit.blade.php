@extends('crm.layouts.nav_admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h3 style="margin-top:50px;">
            <span>Редактировать</span>
        </h3>
        <div>
            {{ Form::model($model, ['url' => route('crm.clients.update', ['client' => $model]), 'method' => 'PATCH']) }}
            @include('crm.clients.blocks.fields')
            {{ Form::close() }}
        </div>
    </main>
@endsection
