<div class="row">
    <div class="col-12">
        @foreach($actions as $action)
            @if($action == 'destroy')
                <form action="{{route('admin.'.$entity_name['m'].'.'.$action, [ $entity_name['s'] => $entity['id']??''])}}" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" value="{{__('admin.destroy')}}">
                </form>
            @else
                <?php
                    $params = [];
                    if(!empty($entity)){
                        $params = [ $entity_name['s'] => $entity['id']];
                    }
                ?>
                {{link_to(route('admin.'.$entity_name['m'].'.'.$action, $params), __('admin.'.$action))}}
            @endif
        @endforeach
    </div>
</div>