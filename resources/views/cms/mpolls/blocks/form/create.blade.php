{!! Form::open(['action' => 'Cms\Mpolls\MpollsController@store']) !!}

@include('cms.mpolls.blocks.form.blocks.fields')

@include('cms.mpolls.blocks.form.blocks.sub_fields')


<div class="row ">
    <div class="col-md-12">
        <button id="add_row" class="btn btn-outline-secondary">Add Quota</button>
        <button id='delete_row' class="pull-right btn btn-danger">Delete Quota</button>
    </div>
</div>
<br>
{!! Form::submit(__('cms.store'), ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

@push('scripts')
    <script>

        $(document).ready(function () {
            var row_number = 0;


            {{--let row_number = {{ $mpoll->quotas->count() }};--}}
            console.log("Row_number: " + row_number);
            $("#add_row").click(function (e) {

                var html = `
<div id="quota${row_number}"  class="card">
    <div "class="card-header">
        <label for="quota_">Quota name: Age#</label>

        <select class="form-control" name="quotas[]">
            <option value="">Choose quota...</option>
            <option value="1">1. Age1</option>
            <option value="2">2. Age2</option>
            <option value="3">3. Age3</option>
</select>
    </div>
    <div class="card-body ">
        <div class="row col-12">
            <div class="row form-group mr-5">
                <label for="completes">completes Qnty: </label>
                <input class="form-control" name="completes[]" type="text" value="0">
            </div>
            <div class="row form-group">
                <label for="completes">Sent Qnty: </label>
                <input class="form-control" name="sent[]" type="text" value="0">
            </div>
        </div>
    </div>
</div><br>
`;
                e.preventDefault();
                let new_row_number = row_number - 1;
                console.log("Row_number: " + row_number, new_row_number);
                // console.log($('#quota' + row_number).html());
                // $('#quota' + row_number).html($('#quota' + new_row_number).html()).find('td:first-child');
                // $('#quota_list').append( );
                $('#quota_list').append(html);
                // $('#quota_list').append('<h1 id="quota' + (row_number + 1) + '">quota ' + (row_number + 1) + '</h1>');
                console.log('HERE');
                // $('#quota_list').append('<tr id="quota' + (row_number + 1) + '"></tr>');
                row_number++;
            });
            $("#delete_row").click(function (e) {
                e.preventDefault();
                if (row_number >= 0) {
                    $("#quota" + (row_number - 1)).html('');
                    row_number--;
                }
            });
        });
    </script>
@endpush
