@include('cms.offers.blocks.form.errors')

{{ Form::model($offer, ['url' => route('cms.offers.update', ['offer' => $offer]), 'method' => 'PUT']) }}
@include('cms.offers.blocks.form.fields', $offer)
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
