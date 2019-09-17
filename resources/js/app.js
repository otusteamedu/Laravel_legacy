require('./bootstrap');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery');
    require('bootstrap');
} catch (e) {}

require('./_maps/loader');

require('./script');
