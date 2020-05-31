
<form method="post" action="/towns/{{$id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger">DEL</button>
</form>
