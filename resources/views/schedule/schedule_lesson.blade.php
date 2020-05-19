<div class="form-group">
    <label for="lesson_type" class="control-label">@lang('scheduler.lesson_type')</label>
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="lecture" name="radio-stacked" required>
        <label class="custom-control-label" for="lecture">@lang('scheduler.lecture')</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="practice" name="radio-stacked" required>
        <label class="custom-control-label" for="practice">@lang('scheduler.practice')</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="consultation" name="radio-stacked" required>
        <label class="custom-control-label" for="consultation">@lang('scheduler.consultation')</label>
    </div>
</div>
<div class="form-group">
    {{--If we choose lecture or practice type--}}
    <label for="group" class="control-label">@lang('scheduler.group')</label>
    <select class="selectpicker form-control" data-live-search="true" id="group">
        <option data-tokens="ketchup mustard">111</option>
        <option data-tokens="mustard">211</option>
        <option data-tokens="frosting">311</option>
    </select>
</div>
<div class="form-group">
    {{--If we choose lecture or practice type--}}
    <label for="subject" class="control-label">@lang('scheduler.subject')</label>
    <select class="selectpicker form-control" data-live-search="true" id="subject">
        <option data-tokens="ketchup mustard">chemistry</option>
        <option data-tokens="mustard">math</option>
    </select>
</div>
<div class="form-group">
    {{--If we choose consultation type--}}
    <label for="teacher" class="control-label">@lang('scheduler.teacher')</label>
    <select class="selectpicker form-control" data-live-search="true" id="teacher">
        <option data-tokens="ketchup mustard">Ivanov Ivan Ivanovich</option>
        <option data-tokens="mustard">Test</option>
    </select>
</div>
<div class="form-group">
    <label for="room" class="control-label">@lang('scheduler.room')</label>
    <select class="selectpicker form-control" data-live-search="true" id="room">
        <option data-tokens="ketchup mustard">101</option>
        <option data-tokens="mustard">102</option>
    </select>
</div>
