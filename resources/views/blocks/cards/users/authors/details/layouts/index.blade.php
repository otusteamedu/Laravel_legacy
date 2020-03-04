<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{$author['photo']}}" class="card-img" alt="{{$author['name']}}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div> @section('header')@show </div>
                <div class="card-text">
                    <span>{{__('cards.authors.about')}}</span><br>
                    <small class="text-muted">{{$author['about'] }}</small>
                </div>
                <div class="card-text mt-2 d-flex"> @section('footer')@show </div>
            </div>
        </div>
    </div>
</div>
