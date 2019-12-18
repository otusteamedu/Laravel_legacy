@extends('layouts.app')
{{--@extends('reading_room_user_page.index')--}}
@section('title', 'Page List ')
{{ Html::style('css/custom.css') }}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div style="float:left;font-size: 36px">
                        @include('include.addLink')
                    </div>

                    <ul class="list-group">
                        <?php /** @var \App\Models\Author $author */?>
                        @foreach ($authors as $author)
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label for="checkbox">
                                        {{$author->surname .  ' ' . $author->name}}
                                    </label>
                                </div>
                                <div class="pull-right action-buttons">


                                    <a href="{{route('admin.authors.show', ['author' => $author])}}"><span
                                            class="glyphicon glyphicon-pencil">Подробнее</span>
                                    </a>

                                    <a href="{{route('admin.authors.edit', ['author' => $author])}}"><span
                                            class="glyphicon glyphicon-pencil">Редактировать</span>
                                    </a>

                                    <a href="{{route('admin.authors.destroy', ['author' => $author])}}"  class="js-destroy trash"><span
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
