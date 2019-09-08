module.exports = function (fonts) {
    var module = {
        'fonts': fonts
    };

    module.load = function () {
        WebFontConfig = {
            google: {families: this.fonts}
        };

        (function () {
            var protocol = 'https:' === document.location.protocol ? 'https' : 'http';
            var wf = document.createElement('script');
            wf.src = protocol + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = true;
            var head = document.getElementsByTagName('head')[0];
            head.appendChild(wf);
        })();
    };

    return module;
};
