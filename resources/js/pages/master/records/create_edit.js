document.addEventListener('DOMContentLoaded', function() {
    // User selector
    M.FormSelect.init(
        document.querySelectorAll('select')
    );

    // Date picker
    let datePicker = document.getElementById('datepicker');
    M.Datepicker.init(
        datePicker,
        {
            defaultDate: (new Date(datePicker.value)),
            setDefaultDate: true,
            firstDay: 1,
            format: 'dd.mm.yyyy',
            i18n: i18nDatePicker
        }
    );

    // Time start picker
    M.Timepicker.init(
        document.querySelectorAll('.timepicker-start'),
        {
            i18n: i18nTimePicker,
            twelveHour: false
        }
    );

    // Time end picker
    M.Timepicker.init(
        document.querySelectorAll('.timepicker-end'),
        {
            i18n: i18nTimePicker,
            twelveHour: false
        }
    );
});

var i18nTimePicker = {
    "cancel": 'Отменить',
    "clear": 'Очистить',
    "done": 'Ок'
};

var i18nDatePicker = {
    "cancel": 'Отменить',
    "clear": 'Очистить',
    "done": 'Ок',
    "previousMonth": '‹',
    "nextMonth": '›',
    "months": [
        'Январь',
        'Феврать',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    ],
    "monthsShort": [
        'Янв',
        'Фев',
        'Мар',
        'Апр',
        'Май',
        'Июн',
        'Июл',
        'Авг',
        'Сен',
        'Окт',
        'Ноя',
        'Дек'
    ],
    "weekdays": [
        'Воскресенье',
        'Понедельник',
        'Вторник',
        'Среда',
        'Четверг',
        'Пятница',
        'Суббота'
    ],
    "weekdaysShort": [
        'Вс',
        'Пн',
        'Вт',
        'Ср',
        'Чт',
        'Пт',
        'Сб'
    ],
    "weekdaysAbbrev": ['В','П','В','С','Ч','П','С']
};
