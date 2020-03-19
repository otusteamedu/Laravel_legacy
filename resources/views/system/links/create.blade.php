@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('link.system.create_page.title')</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('register'), 'method' => 'post']) !!}

                        <div class="form-group row">
                            <label for="type"
                                   class="col-md-4 col-form-label text-md-right">@lang('link.system.label.type')</label>

                            <div class="col-md-6">

                                {!! Form::text('type', old('type'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']); !!}

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">@lang('link.system.label.name')</label>

                            <div class="col-md-6">

                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']); !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="route_name"
                                   class="col-md-4 col-form-label text-md-right">@lang('link.system.label.route_name')</label>

                            <div class="col-md-6">

                                {!! Form::text('route_name', old('route_name'), ['class' => 'form-control', 'required' => 'required']); !!}

                                @error('route_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="disabled"
                                   class="col-md-4 col-form-label text-md-right">@lang('link.system.label.disabled')</label>

                            <div class="col-md-6">

                                {!! Form::checkbox('disabled', 1, old('route_name'), ['class' => 'form-control', 'required' => 'required']); !!}

                                @error('disabled')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('link.system.create_page.submit_button')
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
