$(function() {
    $('table[role="list"]').sortable({
        items: "tbody tr"
    });

    $('input[role="date"]').datepicker({
        language: 'ru',
        locale: 'ru',
        format: 'dd.mm.yyyy'
    });

    $('input[role="phone"]').inputmask({ mask: "(999) 999-99-99" });

    window['submitCmd'] = function(element, cmd, params) {
        var form = element.form,
            inputCmd = form.elements['_cmd'];
        params = params || {};
        params._cmd = cmd;

        for(var name in params) {
            inputCmd = form.elements[name];
            if(!inputCmd) {
                inputCmd = form.appendChild(document.createElement('input'));
                inputCmd.type = 'hidden';
                inputCmd.name = name;
            }
            inputCmd.value = params[name];
        }

        form.submit();
    };
});


