require('./bootstrap');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('jquery-ui');
    //require('jquery-datepicker');
    require('jquery-ui-sortable');

    require('./jquery.inputmask');

    require('./bootstrap-datepicker');

    require('bootstrap');
} catch (e) {}

require('./admin/script');
