@if ($errors->any())
<div class="alert alert-warning alert-danger fade show" role="alert">
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <ul>
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach 
    </ul>  
</div>
@endif
