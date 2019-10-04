<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Сумма в кассе</div>
                    <div class="stat-digit">@isset($group->total_cache){{$group->total_cache}}@endisset</div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.flows.create',$groupID=$group->id)}}">Добавить в поток</a>
            <table class="table table-striped">
                <tbody>
                @forelse ($flows as $flow)
                <tr>
                    <td>{{$flow->operation}}</td>
                    <td>{{$flow->created_at}}<br>
                        {{$flow->cash}}<br>
                        {{$flow->text}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td>-</td>
                    <td>-</td>

                </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>