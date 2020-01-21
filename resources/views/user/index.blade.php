@extends('base.layout')

@section('content')
    <div class="row container-user mt-4">
        <div class="col-12 col-md-4 text-center">
            <div><img src="https://www.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg" class="img-fluid rounded-circle" alt="Responsive image"></div>
            <h3 class="mt-3">Samuel L Jackson</h3>
        </div>
        <div class="col-12 col-md-4">
            @include('user.forms.personal')
        </div>
    </div>
@endsection

