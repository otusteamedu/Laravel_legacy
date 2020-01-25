document.addEventListener('DOMContentLoaded', function() {
    // User selector
    var userSelectInstance = M.FormSelect.init(document.querySelectorAll('select'));

    // Date picker
    let datePicker = document.getElementById('datepicker');
    var datePickerInstance = M.Datepicker.init(
        datePicker,
        {
            defaultDate: (new Date(datePicker.value)),
            setDefaultDate: true
        }
    );

    // Time start picker
    var timePickerStartInstance = M.Timepicker.init(document.querySelectorAll('.timepicker-start'));

    // Time end picker
    var timePickerEndInstance = M.Timepicker.init(document.querySelectorAll('.timepicker-end'));
});
