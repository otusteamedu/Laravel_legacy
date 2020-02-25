<div class="col-md-8 order-md-1">
    <h4 class="mb-3">Billing address</h4>
{{--    <form class="needs-validation" novalidate>--}}
        {!! Form::open(['url' => 'foo/bar', 'method' => 'post', 'class' => 'needs-validation was-validated', 'novalidate']) !!}
        <div class="row">
            <div class="col-md-6 mb-3">
                {{ Form::label('firstName', 'First name', ['class' => '']) }}
                {{ Form::text('firstName', null, ['class' => 'form-control', 'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Valid first name is required.'])
            </div>
            <div class="col-md-6 mb-3">
                {{ Form::label('lastName', 'Last name', ['class' => '']) }}
                {{ Form::text('lastName', null, ['class' => 'form-control', 'required']) }}
                @include('checkout.blocks.errField', ['text' => ' Valid last name is required.'])
            </div>
        </div>

        <div class="mb-3">
            {{ Form::label('username', 'Username', ['class' => '']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => "Username" ,'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Your username is required.'])
            </div>
        </div>

        <div class="mb-3">
            {{ Form::label('email', "Email (Optional)", ['class' => '']) }}
            {{ Form::email('email', null, array('class'=>'form-control', 'placeholder' => 'you@example.com')) }}
            @include('checkout.blocks.errField', ['text' => ' Please enter a valid email address for shipping updates.'])
        </div>

        <div class="mb-3">
            {{ Form::label('address', "Address", ['class' => '']) }}
            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => "1234 Main St" ,'required']) }}
            @include('checkout.blocks.errField', ['text' => 'Please enter your shipping address.'])
        </div>

        <div class="mb-3">
            {{ Form::label('address2', "Address 2 (Optional)", ['class' => '']) }}
            {{ Form::text('address2', null, ['class' => 'form-control', 'placeholder' => "Apartment or suite"]) }}
        </div>

        <div class="row">
            <div class="col-md-5 mb-3">
                {{ Form::label('country', "Country", ['class' => '']) }}
                {{ Form::select('size', ['Chose' => 'Choose...', 'US' => 'United States'], 'Chose', ['class' => 'custom-select d-block w-100']) }}
                @include('checkout.blocks.errField', ['text' => 'Please select a valid country.'])
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('state', "State", ['class' => '']) }}
                {{ Form::select('size', ['Chose' => 'Choose...', 'California' => 'California'], 'Chose', ['class' => 'custom-select d-block w-100']) }}
                @include('checkout.blocks.errField', ['text' => ' Please provide a valid state.'])
            </div>
            <div class="col-md-3 mb-3">
                {{ Form::label('zip', "Zip", ['class' => '']) }}
                {{ Form::text('zip', null, ['class' => 'form-control', 'placeholder' => "", 'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Zip code required.'])
            </div>
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
            {{ Form::checkbox('same-address', '1', false ,['class' => 'custom-control-input']) }}
            {{ Form::label('zip', "Shipping address is the same as my billing address", ['class' => 'custom-control-label']) }}
        </div>
        <div class="custom-control custom-checkbox">
            {{ Form::checkbox('save-info', '1', false ,['class' => 'custom-control-input']) }}
            {{ Form::label('zip', "Save this information for next time", ['class' => 'custom-control-label']) }}
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                {{ Form::radio('paymentMethod', '1', true ,['class' => 'custom-control-input', 'required']) }}
                {{ Form::label('paymentMethod', "Credit card", ['class' => 'custom-control-label']) }}
            </div>
            <div class="custom-control custom-radio">
                {{ Form::radio('paymentMethod', '1', false ,['class' => 'custom-control-input', 'required']) }}
                {{ Form::label('paymentMethod', "Debit card", ['class' => 'custom-control-label']) }}
            </div>
            <div class="custom-control custom-radio">
                {{ Form::radio('paymentMethod', '1', false ,['class' => 'custom-control-input', 'required']) }}
                {{ Form::label('paymentMethod', "PayPal", ['class' => 'custom-control-label']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                {{ Form::label('cc-name', "Name on card", ['class' => '']) }}
                {{ Form::text('cc-name', null, ['class' => 'form-control', 'placeholder' => "", 'required']) }}
                <small class="text-muted">Full name as displayed on card</small>
                @include('checkout.blocks.errField', ['text' => 'Name on card is required'])
            </div>
            <div class="col-md-6 mb-3">
                {{ Form::label('cc-number', "Credit card number", ['class' => '']) }}
                {{ Form::text('cc-number', null, ['class' => 'form-control', 'placeholder' => "", 'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Credit card number is required'])
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                {{ Form::label('cc-expiration', "Expiration", ['class' => '']) }}
                {{ Form::text('cc-expiration', null, ['class' => 'form-control', 'placeholder' => "", 'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Expiration date required'])
            </div>
            <div class="col-md-3 mb-3">
                {{ Form::label('cc-cvv', "CVV", ['class' => '']) }}
                {{ Form::text('cc-cvv', null, ['class' => 'form-control', 'placeholder' => "", 'required']) }}
                @include('checkout.blocks.errField', ['text' => 'Security code required'])
            </div>
        </div>
        <hr class="mb-4">
    {{ Form::submit('Continue to checkout' , ['class' => 'btn btn-primary btn-lg btn-block']) }}
    {!! Form::close() !!}
</div>


