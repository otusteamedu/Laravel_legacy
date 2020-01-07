{{-- также можно использовать @if($errors->any()) --}}
@if(count($errors)>0)
  <div id="errors" class="callout alert">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

