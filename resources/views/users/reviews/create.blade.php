@extends('layouts.user')

@section('title', 'Add review')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('user.addReview')</h4>
                    <form action="{{route('reviews.store')}}" method="post" class="form-horizontal m-t-40">
                        @csrf
                        <div class="form-group">
                            <label>@lang('user.review')</label>
                            <textarea name="review" class="form-control" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">@lang('user.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection