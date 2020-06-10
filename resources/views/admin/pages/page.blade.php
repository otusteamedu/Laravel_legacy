@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-edit"></i>
            Buttons
          </h3>
        </div>
        <div class="card-body pad table-responsive">
          <a style="width:30%;" href="/admin/pages/add" class="btn btn-block btn-primary">Добавить страницу</a>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.col -->
  </div>

<div class="card">

    <div class="card-header">


      <h3 class="card-title">Список страниц</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
          <thead>
              <tr>
                  <th style="width: 1%">
                      #
                  </th>
                  <th style="width: 20%">
                      Название страницы
                  </th>
                  <th style="width: 30%">
                      Meta title
                  </th>
                  <th>
                     Meta keywords
                  </th>
                  <th style="width: 18%" class="text-center">
                        ЧПУ
                  </th>
                  <th style="width: 20%">
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($list as $item)
             <tr>
                <td>
                    {{ $item->id }}
                </td>
                <td>
                    <a>
                        {{ $item->title }}
                    </a>
                    <br>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    {{ $item->meta_title }}
                </td>
                <td class="project_progress">
                    {{ $item->meta_keywords }}

                </td>
                <td class="project-state">
                    {{ $item->slug }}

                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route($editRoute, ['id' => $item->id]) }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>

             </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    {{ $list->links() }}
  </div>
@stop
