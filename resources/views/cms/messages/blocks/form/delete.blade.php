
<form method="post" action="/messages/{{$id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn">&#10006;</button>
</form>
