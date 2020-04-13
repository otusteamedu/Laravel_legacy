{{--{{ dd($quota) }}--}}
<div id="quota0" class="card">

    <div class="card-header">
        {{ Form::label('quota', 'Quota name: ' ) }}
        {{--        {{ Form::text('quota_id[]', $quota->id, ['class' => 'form-control']) }}--}}
        {{ Form::select('quotas[]', $quotas->pluck('id_name' ,'id' )->toArray() ,null ,['class' => 'form-control', 'placeholder' => 'Choose quota...']) }}
    </div>

    <div class="card-body ">

        <div class="row col-12">

            <div class="row form-group mr-5">
                {{ Form::label('completes', 'completes Qnty: ') }}
                {{ Form::text('completes[]', 0, ['class' => 'form-control']) }}
            </div>

            <div class="row form-group">
                {{ Form::label('completes', 'Sent Qnty: ') }}
                {{ Form::text('sent[]', 0, ['class' => 'form-control']) }}
            </div>

        </div>
    </div>
</div>
<br>


