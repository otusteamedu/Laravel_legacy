<thead>
<tr>
    @foreach($headers as $header)
        <th scope="col">{{$header['title']}}</th>
    @endforeach
    @if(!empty($links))
        <th scope="col">{{__('admin.links')}}</th>
    @endif
</tr>
</thead>