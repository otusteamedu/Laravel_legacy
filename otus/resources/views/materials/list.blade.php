@extends('layouts.app')

@section('title', 'Page List ')
{{ Html::style('css/custom.css') }}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div style="float:left;font-size: 36px">
                        <a href="{{route('admin.materials.create')}}"><span
                                class="glyphicon glyphicon-pencil">Добавить</span>
                        </a>
                    </div>

                    <ul class="list-group">
                        <?php /** @var \App\Models\Material $material */?>
                        @foreach ($materials as $material)
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label for="checkbox">
                                        {{$material->name }}<br/>
                                        @foreach ($material->favorites as $favorite)
                                            id таблицы избранного {{$favorite->id}}<br/>
                                            @endforeach

                                    </label>
                                </div>
                                <div class="pull-right action-buttons">

                                    <a href="{{route('admin.materials.show', ['material' => $material])}}"><span
                                            class="glyphicon glyphicon-pencil">Подробнее</span>
                                    </a>

                                    <a href="{{route('admin.materials.edit', ['material' => $material])}}"><span
                                            class="glyphicon glyphicon-pencil">Редактировать</span>
                                    </a>

                                    <a href="{{route('admin.materials.destroy', ['material' => $material])}}"  class="js-destroy trash"><span
                                            class="glyphicon glyphicon-trash">Удалить</span>
                                    </a>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

        $('.js-destroy').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $url = $this.attr('href');
            console.log($url);
            $.ajax({
                url: $url,
                data: { _token: '{{csrf_token()}}' },
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        });
    });
</script>
@endsection
