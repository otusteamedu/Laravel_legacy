<div class="card">
    <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse"
                    data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                {{__('profile.account')}}
            </button>
        </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
         data-parent="#accordionExample">
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{__('profile.name')}}</label>
                <input id="name" class="form-control">
            </div>
        </div>
    </div>
</div>
