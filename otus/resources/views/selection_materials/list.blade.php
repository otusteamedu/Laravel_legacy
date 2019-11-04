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
                        <a href="{{route('admin.selection-materials.create')}}"><span
                                class="glyphicon glyphicon-pencil">Добавить</span>
                        </a>
                    </div>

                    <ul class="list-group">
                        <?php /** @var \App\Models\SelectionMaterial $selectionMaterial */?>
                        @foreach ($selectionMaterials as $selectionMaterial)
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label for="checkbox">
                                        {{$selectionMaterial->name }}
                                    </label>
                                </div>
                                <div class="pull-right action-buttons">

                                    <a href="{{route('admin.selection-materials.show', ['selectionMaterial' => $selectionMaterial])}}"><span
                                            class="glyphicon glyphicon-pencil">Подробнее</span>
                                    </a>

                                    <a href="{{route('admin.selection-materials.edit', ['selectionMaterial' => $selectionMaterial])}}"><span
                                            class="glyphicon glyphicon-pencil">Редактировать</span>
                                    </a>

                                    <a href="{{route('admin.selection-materials.destroy', ['selectionMaterial' => $selectionMaterial])}}"  class="js-destroy trash"><span
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $('.js-destroy').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $url = $this.attr('href');
            console.log($this.attr('href'));
            $.ajax({
                url: $url,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        });
    });
</script>
@endsection
