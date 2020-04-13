<?php /** @var \App\Models\Mpoll $mpoll */ ?>
<tr>
    <td scope="row">{{ link_to(route('cms.mpolls.edit', ['mpoll' => $mpoll->id]), $mpoll->id) }}</td>
    <td> {{ $mpoll->mstatus_id ? 'Process' : 'Disable'  }} </td>
    {{--    <td> {{ $mpoll->quota_id }} </td>--}}
    <td>{{ link_to(route('cms.mpolls.edit', ['mpoll' => $mpoll->id]), $mpoll->name) }}</td>
    <td> {{ $mpoll->price }} </td>
    <td> {{ $mpoll->country_id }} </td>
    <td> {{ $mpoll->click }} </td>
    <td> {{ $mpoll->cab_price }} </td>
    <td> {{ ($mpoll->check_geo) ? 'Yes' : 'No' }} </td>
    <td> {{ $mpoll->incabinet  ? 'Yes' : 'No' }} </td>
    <td> {{ $mpoll->description }} </td>
    <td> @date( $mpoll->created_at )</td>
    <td> @date( $mpoll['updated_at'] )</td>
    @if ($mpoll['deleted_at'])
        <td></td>
        <td>  @date( $mpoll['deleted_at'])  </td>
    @else
        <td>Exists</td>
    @endif
        <td>
            {!! Form::open(['url' => route('cms.mpolls.destroy',  $mpoll->id), 'method' => 'delete', 'class' => '']) !!}
            <button class='btn btn-danger table-buttons' type='submit' value='submit'>
                <i class='fas fa-trash'></i></button>
        </td>
</tr>



