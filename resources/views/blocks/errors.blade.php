{{-- также можно использовать @if($errors->any()) --}}
@if(count($errors)>0)
  <div class="callout danger">  
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

