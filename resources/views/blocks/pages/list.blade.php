<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach($items[0] as $k => $v)
                                    <th>{{$k}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                @foreach($item as $el)
                                <td><a href="#">{{$el}}</a></td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<a href="#" type="button" class="btn btn-primary">@lang('buttons.add')</a>
<hr>
