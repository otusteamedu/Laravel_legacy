@extends('layouts.user')

@section('title', 'Reviews')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('user.listOfReviews')</h4>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10%">Имя</th>
                                <th style="width: 80%">Отзыв</th>
                                <th style="width: 10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td style="width: 10%">{{$review->user->name}}</td>
                                    <td style="width: 80%">{{$review->text}}</td>
                                    <td style="width: 10%">
                                        @canany(['update', 'delete'], $review)
                                        <a href="{{route('reviews.edit', ['review' => $review->id])}}">
                                            <i class="fas fa-edit" title="@lang('user.edit')"></i>
                                        </a>
                                        <form action="{{route('reviews.destroy', ['review' => $review->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0);" onclick="parentNode.submit();">
                                                <i class="fas fa-trash" title="@lang('user.delete')"></i>
                                            </a>
                                        </form>
                                        @endcanany
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- This is data table -->
    <script src="/assets/plugins/datatables/datatables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script src="/js/datatables.custom.js"></script>
@endsection