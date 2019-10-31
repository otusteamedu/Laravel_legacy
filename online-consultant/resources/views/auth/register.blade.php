@extends('web.layouts.index')

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            @component('common.forms.register')@endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection