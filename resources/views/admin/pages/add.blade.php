@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<form role="form" action="{{ route($addRoute) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">General</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="inputTitle">Название страницы</label>
            <input type="text" name="title" id="inputTitle" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="inputMetaKeywords">Meta keyword</label>
            <input type="text" name="meta_keywords" id="inputMetaKeywords" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="inputMetaTitle">Meta title</label>
            <input type="text" name="meta_title" id="inputMetaTitle" class="form-control" value="">
          </div>
                <div class="form-group">
            <label for="inputSlug">ЧПУ</label>
            <input type="text" name="slug" id="inputSlug" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="inputContent"> Содержимое страницы</label>
            <textarea id="inputContent" name="content" class="form-control" rows="4"></textarea>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>


<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a type="button" href="{{ route($backRoute) }}" class="btn btn-warning">Back</a>
    </form>

    </div>
</div>



@stop
