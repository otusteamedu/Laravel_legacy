/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// TODO put config vars in separate file
const fonts = ['Nunito:400,600'];
const web_fonts_loader = require('../modules/webfonts')(fonts);
web_fonts_loader.load();

(function($) {
    $(document).ready(function () {

    });
})(jQuery);
