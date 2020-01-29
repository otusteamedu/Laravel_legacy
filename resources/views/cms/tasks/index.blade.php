@extends('cms.main')
@section('content')
    <h1 class="h3 text-center mt-5">Работа с задачами</h1>
    @include('cms.include.message')
    <hr class="mb-5">
    <section>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Проект</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Поручено</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->project->name}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->user->name}}</td>
                    <td>
                        <a href="{{route('csm.tasks.edit',$value->id)}}" class="btn btn-dark mb-2">Изменить</a>
                        {{Form::open(['route'=>['csm.tasks.destroy',$value->id],'method' => 'DELETE'])}}
                        {{Form::submit('Удалить',['class' => 'btn btn-danger ml-1'])}}
                        {{Form::close()}}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('csm.tasks.create')}}" class="btn btn-success float-right">Добавить</a>
    </section>
    {{ $data->links() }}
@endsection




