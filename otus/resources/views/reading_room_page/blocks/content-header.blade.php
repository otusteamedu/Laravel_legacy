@php /** @var \App\Models\Compilation $compilation */
 $users = \App\Models\User::all();
@endphp
<div class="contentHeader">
    <div class="contentHeader__wrap">
        <div class="titleContent">
            <div class="titleContent__titleText">@lang('messages.reading_room')</div>
            <div class="titleContent__countBooks">{{$users->count()}} @lang('messages.employees')</div>
        </div>
    </div>
</div>
