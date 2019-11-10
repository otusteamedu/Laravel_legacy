@extends('layouts.app')

@section('title', 'Page List ')
{{ Html::style('css/custom.css') }}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <a href="{{route('admin.reviews.create')}}"><span
                            class="glyphicon glyphicon-pencil">Добавить</span>
                    </a>

                    <ul class="list-group">
                        <?php /** @var App\Models\Review $review */?>
                        @foreach ($reviews as $review)
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label for="checkbox">
                                        Имя пользователя: {{$review->user->name}}<br/>
                                        Имя матриала: {{$review->material->name}}<br/>
                                        Отзыв: {{$review->review}}<br/>
                                    </label>
                                </div>
                                <div class="pull-right action-buttons">

                                    <a href="{{route('admin.reviews.show', ['review' => $review])}}"><span
                                            class="glyphicon glyphicon-pencil">Подробнее</span>
                                    </a>

                                    <a href="{{route('admin.reviews.edit', ['review' => $review])}}"><span
                                            class="glyphicon glyphicon-pencil">Редактировать</span>
                                    </a>

                                    <a href="{{route('admin.reviews.destroy', ['review' => $review])}}"  class="js-destroy trash"><span
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
            console.log($this.attr('href'));
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
