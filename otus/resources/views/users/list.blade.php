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
                        @include('include.addUserLink')
                    </div>

                    <ul class="list-group">
                        <?php /** @var \App\Models\user $user */?>
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <img src = {{asset($user->photo)}}>
                                    <label for="checkbox">
                                        {{$user->name . ' ' . $user->email}}
                                    </label>
                                </div>
                                <div class="pull-right action-buttons">

                                    <a href="{{route('admin.users.show', ['user' => $user])}}"><span
                                            class="glyphicon glyphicon-pencil">Подробнее</span>
                                    </a>

                                    <a href="{{route('admin.users.edit', ['user' => $user])}}"><span
                                            class="glyphicon glyphicon-pencil">Редактировать</span>
                                    </a>

                                    <a href="{{route('admin.users.destroy', ['user' => $user])}}"  class="js-destroy trash"><span
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
