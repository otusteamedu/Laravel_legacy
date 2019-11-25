require('./bootstrap');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery');
    require('bootstrap');
} catch (e) {}

require('./_maps/loader');

require('./jquery.inputmask');

require('./bootstrap-datepicker');

require('./moment');

// require('./locale/ru');

require('./script');
