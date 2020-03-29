@include('offers.blocks.form.errors')

{{ Form::model($offer, ['url' => route('cms.offers.update', ['offer' => $offer]), 'method' => 'PUT']) }}
@include('offers.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Изменить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
