{!! Form::open(['url' => route('links.destroy', [$link]), 'method' => 'DELETE']) !!}
<button type="submit" class="btn btn-primary">
    @lang('link.system.delete_button')
</button>
{!! Form::close() !!}
