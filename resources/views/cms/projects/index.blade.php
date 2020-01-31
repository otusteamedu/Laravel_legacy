@extends('cms.main')
@section('content')
    <h1 class="h3 text-center mt-5">Работа с проектами</h1>
    @include('cms.include.message')
    <hr class="mb-5">
    <section>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->name}}</td>
                    <td>
                        <div class="row">
                            <a href="{{route('csm.projects.edit',['lang' => app()->getLocale(), $value->id])}}" class="btn btn-dark">Изменить</a>
                            {{Form::open(['route'=>['csm.projects.destroy', 'lang' => app()->getLocale(), $value->id],'method' => 'DELETE'])}}
                            {{Form::submit('Удалить',['class' => 'btn btn-danger ml-1'])}}
                            {{Form::close()}}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('csm.projects.create',['lang' => app()->getLocale()])}}" class="btn btn-success float-right">Добавить</a>
    </section>
    {{ $data->links() }}
@endsection




