{{--{{ dd($quota) }}--}}
<div id="quota{{ $loop->index }}" class="card">
    <div class="card-header">
        {{ Form::label('quota', 'Quota name: ' . $quota->name) }}
        {{--        {{ Form::text('quota_id[]', $quota->id, ['class' => 'form-control']) }}--}}
        {{ Form::select('quotas[]', $quotas->pluck('id_name' ,'id' )->toArray() ,$quota->id ,['class' => 'form-control', 'placeholder' => 'Choose quota...']) }}
    </div>
    <div class="card-body ">
        <div class="row col-12">
            <div class="row form-group mr-5">
                {{ Form::label('completes', 'completes Qnty: ') }}
                {{ Form::text('completes[]', $quota->pivot->completes, ['class' => 'form-control']) }}
            </div>
            <div class="row form-group">
                {{ Form::label('completes', 'Sent Qnty: ') }}
                {{ Form::text('sent[]', $quota->pivot->sent, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</div>

<br>

