$(function () {
    var object = document.getElementById('mapElement');
    if(object) {
        MapLoader = new mapLoader(object, {
            urlData: "/cinemas/map_data",
            onSelect: function(pointData) {
                /*
                var node, id, i, j, k, form = $('[data-role="calculator"]').get(0),
                    vars = ['regionId', 'districtId', 'pointId'], tagName, value, si, pfx;

                for(i = 0; i < vars.length; i++)
                {
                    for(j = 0; j < 2; j++) {
                        pfx = j ? 'old_' : '';
                        id = 'ctrl_LOCATION_' + pfx + vars[i];
                        node = document.getElementById(id);

                        if(!node) {
                            node = form.appendChild(document.createElement('input'));
                            node.type = 'hidden';
                            node.name = 'LOCATION[' + pfx + vars[i] + ']';
                        }

                        tagName = node.tagName.toLowerCase();
                        value = pointData[vars[i]];

                        if(tagName == 'input')
                            node.value = value;
                        else
                        if(tagName == 'select') {
                            si = -1;
                            for(k = 0; k < node.options.length; k++)
                                if(node.options[k].value == value) {
                                    si = k;
                                    node.options[k].selected = true;
                                }
                                else
                                    node.options[k].selected = false;
                            if(si >= 0)
                                node.selectedIndex = si;
                            else {
                                node.parentNode.removeChild(node);

                                node = form.appendChild(document.createElement('input'));
                                node.type = 'hidden';
                                node.name = 'LOCATION[' + pfx + vars[i] + ']';
                                node.value = value;
                            }
                        }
                    }
                }

                $(form).submit();
                $.modal.closePopup();*/
            }
        });
        MapLoader.loadList(null);
    }

    $('input[role="date"]').datepicker({
        language: 'ru',
        locale: 'ru',
        format: 'dd.mm.yyyy'
    });

    $('.input-phone').inputmask({ mask: "(999) 999-99-99" });
});
