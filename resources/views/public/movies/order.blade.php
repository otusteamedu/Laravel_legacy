@extends('public.movies.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.movies.search'),
            'title' => __('public.menu.showing'),
        ], [
            'url' => \route('public.movies.view', ['id' => $movie['id']]),
            'title' => $movie['name'],
        ], [
            'url' => \route('public.movies.showing', ['id' => $movie['id']]),
            'title' => __('public.showings'),
        ], [
            'url' => \route('public.movies.order', ['id' => $movie['id']]),
            'title' => __('public.order_ticket'),
        ]
    ];
@endphp

@section('pageTitle')
    {{ $movie['name'] }}: заказ билета
@endsection

@section('pageHeader')
    Заказ билета
@endsection

@section('pageContentMain')
    <div id="nodeShowing"
         data-role="showing"
         data-showing-id="{{ $showing['id'] }}"
         data-showing-date="{{ $showing['date'] }}"
         data-showing-time="{{ $showing['time'] }}"
         data-movie-name="{{ $movie['name'] }}"
         data-movie-duration="{{ $movie['duration'] }}"
    >
        <form class="places-selected" data-role="selected">
            <div data-role="input"></div>
            <ul data-role="items"></ul>
            <input type="submit" class="btn btn-success shadow" value="Заказать" data-role="button" />
        </form>
        <div class="i-title"><span>Выберите места и нажмите кнопку заказать</span></div>
        <div class="container-fluid order-ticket i-iblock">
            <div class="row align-items-start m-0">
                <div class="col-md-6" data-role="hall" class="hall-area">
                @foreach($places as $place)
                    <div class="place-item"
                         data-role="place"
                         data-place-id="{{ $place['id'] }}"
                         data-place-row="{{ $place['row_number'] }}"
                         data-place-place="{{ $place['place_number'] }}"
                         data-tariff-id="{{ $place['tariff']['id'] }}"
                         data-tariff-code="{{ $place['tariff']['code'] }}"
                         data-tariff-name="{{ $place['tariff']['name'] }}">
                        <span><i>{{ $place['place_number'] }}</i></span>
                    </div>
                @endforeach
                </div>
                <div class="col-md-6">
                    <h5><b>Фильм</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td><b>Название:</b></td>
                            <td>{{ $movie['name'] }}</td>
                        </tr>
                        <tr>
                            <td><b>Длительность:</b></td>
                            <td>{{ $movie['duration'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table>
                    <br />
                    <h5><b>Сеанс</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="25%"><b>Дата:</b></td>
                            <td width="25%">{{ $showing['date'] }}</td>
                            <td width="25%"><b>Время:</b></td>
                            <td width="25%">{{ $showing['time'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table>
                    <br />
                    <h5><b>Место</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td><b>Кинотеатр:</b></td>
                            <td>{{ $hall['cinema']['name'] }}<br />
                                <small>{{ $hall['cinema']['address'] }}</small>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Зал:</b></td>
                            <td>№{{ $hall['number'] }}&nbsp;&laquo;{{ $hall['name'] }}&raquo;</td>
                        </tr>
                        </tbody>
                    </table>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    <div class="container-fluid">
        <a class="btn btn-primary shadow" href="{{ route('public.movies.view', ['id' => $movie['id']]) }}" role="button">
            О фильме
        </a>
        <a class="btn btn-primary shadow" href="{{ route('public.movies.search') }}" role="button">
            Вернуться
        </a>
    </div>
    <script type="text/javascript">
        (function(w, $) {
            var MovieShowing = function(node, prices) {
                this.node = node;

                this.data = Util.getOpts(node, {}, 'showing');
                this.hall = null;
                this.prices = this.initPrices(prices);
            };
            MovieShowing.prototype.init = function() {
                var node;
                node = Util.FindRole('hall', this.node);
                if(node.length > 0) {
                    this.hall = new Hall(node[0], this);
                    this.hall.init();
                }

            };
            MovieShowing.prototype.getResult = function() {
                var i, item, price,
                    places = this.hall.places,
                    result = {
                        showing: this.data,
                        places: []
                    };

                for(i = 0; i < places.length; i++) {
                    if(places[i].selected) {
                        price = this.prices.findByKey(places[i].tariff.getId(), 'tariffId');
                        result[result.length] = {
                            id: places[i].id,
                            row: places[i].row,
                            place: places[i].place,
                            price: price.getValue()
                        };
                    }
                }

                return result;
            };
            MovieShowing.prototype.initPrices = function(data) {
                var i, result;
                if(!data) return;
                result = new collection();
                for(i = 0; i < data.length; i++) {
                    result.addWithKey(
                        new Price(data[i].id, data[i].tariff_id, data[i].value),
                        'tariffId'
                    );
                }
                return result;
            };
            MovieShowing.prototype.update = function() {
                console.log(this.getResult());
            };

            var TicketOrdered = function() {
                this.placeId = 0;
                this.showingId = 0;
                this.orderId = 0;
                this.orderItemId = 0;
            };


            var Hall = function (node, parent) {
                this.node = node;
                this.parent = parent;

                this.id = node.getAttribute('data-id');
                this.name = node.getAttribute('data-name');
                this.places = [];
                this.rowLabels = [];
                this.maxRow = 0;
                this.maxPlace = 0;
            };
            Hall.prototype.init = function() {
                var node, i, item, that = this;
                node = Util.FindRole('place', this.node);
                this.initCss();
                for(i = 0; i < node.length; i++) {
                    item = new Place(node[i], this);
                    item.init();
                    if(item.row > this.maxRow)
                        this.maxRow = item.row;
                    if(item.place > this.maxPlace)
                        this.maxPlace = item.place;
                    this.places[i] = item;
                }

                this.makePlacesPositions();
                Util.attach(window, 'resize', function() {
                    that.makePlacesPositions();
                })
            };
            Hall.prototype.makePlacesPositions = function() {
                var i, w = this.node.offsetWidth, place;
                h = parseInt(w/this.maxPlace*this.maxRow);

                this.setHeight(h);
                w = parseInt(w / this.maxPlace);
                h = parseInt(h / this.maxRow);

                for(i = 0; i < this.places.length; i++) {
                    place = this.places[i];
                    this.places[i].setDimensions(
                        w, h,
                        (place.place-1) * w,
                        (place.row-1) * h,
                    );
                }
            };
            Hall.prototype.update = function() {
                this.parent.update();
            };
            Hall.prototype.initCss = function() {
                this.node.style.position = 'relative';
            };
            Hall.prototype.setHeight = function(h) {
                this.node.style.height = h + 'px';
            };

            var Place = function (node, parent) {
                var data;
                this.node = node;
                this.parent = parent;

                data = Util.getOpts(node, {}, 'place');
                this.id = data.id;
                this.row = parseInt(data.row);
                this.place = parseInt(data.place);

                data = Util.getOpts(node, {}, 'tariff');
                this.tariff = new Tariff(data.id, data.code, data.name);

                this.disabled = !!node.getAttribute('data-disabled');
                this.selected = !!node.getAttribute('data-selected');
                this.own = !!node.getAttribute('data-own');
            };
            Place.prototype.init = function() {
                var that = this;
                this.initCss();
                Util.attach(this.node, 'click', function(e) {
                    that.click();
                });
                this.update();
            };
            Place.prototype.click = function() {
                if(this.disabled)
                    return;
                this.selected = !this.selected;
                this.update();
                this.parent.update();
            };
            Place.prototype.update = function() {
                var className = 'place';
                if(this.disabled)
                    className += ' place-disabled';
                else if(this.own)
                    className += ' place-own';
                else {
                    className += ' place-type-' + this.tariff.getCode().toLowerCase();
                    if(this.selected)
                        className += ' place-selected';
                }

                this.node.className = className;
            };
            Place.prototype.initCss = function() {
                this.node.style.position = 'absolute';
            };
            Place.prototype.setDimensions = function(w, h, l, t) {
                this.node.style.top = t + 'px';
                this.node.style.left = l + 'px';
                this.node.style.width = w + 'px';
                this.node.style.height = h + 'px';
            };

            var Tariff = function (id, code, name) {
                this.id = id;
                this.code = code;
                this.name = name;
            };
            Tariff.prototype.getId = function() {
                return this.id;
            };
            Tariff.prototype.getCode = function() {
                return this.code;
            };
            Tariff.prototype.getName = function() {
                return this.name;
            };

            var Price = function (id, tariffId, value) {
                this.id = id;
                this.tariffId = tariffId;
                this.value = value;
            };
            Price.prototype.getValue = function() {
                return this.value;
            }

            w.jMovieShowing = MovieShowing;

            var collection = function() {
                this.items = [];
                this.cache = [];
            };

            collection.prototype.setCache = function(keys) {
                var i, key;
                for(i = 0; i < this.items.length; i++) {
                    key = this.cacheKey(this.items[i], keys);
                    this.cache[this.cache.length] = i;
                }
            };
            collection.prototype.add = function(item) {
                this.items[this.items.length] = item;
            };
            collection.prototype.addWithKey = function(item, field) {
                var value = item[field],
                    i = this.items.length;
                this.items[i] = item;
                this.cache[value] = i;
            };
            collection.prototype.findByKey = function(item, key) {
                var i = (typeof this.cache[key] == 'undefined') ? -1 : this.cache[key];
                return (i >= 0) ? this.items[i] : null;
            };
            collection.prototype.cacheKey = function(item, keys) {
                var i, key = [];
                if(keys) {
                    for(i in keys)
                        key[key.length] = i + ':' + keys[i];
                }
                else {
                    for(i in item)
                        key[key.length] = i + ':' + item[i];
                }
                return key.join(';');
            };
            collection.prototype.findBy = function(needle) {
                var i, j, found;
                if(!needle)
                    return null;
                for(i = 0; i < this.items.length; i++) {
                    found = true;
                    for(j in needle) {
                        if(this.items[i][j] != needle[j]) {
                            found = false;
                            break;
                        }
                    }
                    if(found)
                        return this.items[i];
                }
                return null;
            };
            collection.prototype.quickBy = function(value) {
                var key = this.cacheKey(value),
                    i = (typeof this.cache[key] == 'undefined') ? -1 : this.cache[key];
                return (i >= 0) ? this.items[i] : null;
            };
            collection.prototype.walk = function(func) {
                var i;
                for(i = 0; i < this.items.length; i++)
                    func.apply(this, [i, this.items[i]]);
            };

            var Util = {
                Find: function(search, attr, context) {
                    var i, j, elems, cls, find,
                        tilda = false, dot = false, res = [];
                    if(!context) context = document.body;
                    if(search[0]=='~') {
                        tilda = true;
                        search = search.substr(1);
                    }
                    else if(search[0]=='.') {
                        dot = true;
                        search = search.substr(1);
                        attr = 'class';
                    }
                    if(!attr) attr = 'id';
                    if(attr == 'id') {
                        find = document.getElementById(search);
                        return find ? [find] : 0;
                    }
                    else {
                        if(tilda || !context.querySelector) {
                            tag = '*';
                            elems = context.getElementsByTagName(tag);
                            for(i = 0; i < elems.length; i++) {
                                if(find = elems[i].getAttribute(attr)) {
                                    if(dot) {
                                        cls = find ? find.split(' ') : [];
                                        for(j = 0; j < cls.length; j++)
                                            if(cls[j] == search)
                                                res[res.length] = elems[i];
                                    }
                                    else if(tilda) {
                                        if(find.indexOf(search)>=0)
                                            res[res.length] = elems[i];
                                    }
                                    else if(find == search)
                                        res[res.length] = elems[i];
                                }
                            }
                            return res;
                        }
                        else {
                            find = '['+attr+'="'+search+'"]';
                            elems = context.querySelectorAll(find);
                            for(i = 0; i < elems.length; i++)
                                res[res.length] = elems[i];
                        }
                    }
                    return res;
                },
                FindRole: function(search, context) {
                    return this.Find(search, 'data-role', context);
                },
                getOpts: function(node, params, pfx) {
                    var a = node.attributes, p;
                    if(!params) params = {};
                    if(pfx) pfx = 'data-'+pfx.toLowerCase()+'-';
                    else pfx = 'data-';
                    for (var i = 0; i < a.length; i++) {
                        if(a[i].name.indexOf(pfx)==0) {
                            p = a[i].name.substr(pfx.length).toLowerCase();
                            p = p.replace(/\-([a-z])/g,
                                function(s) { return s[1].toUpperCase(); }
                            );
                            params[p] = a[i].value;
                        }
                    }

                    return params;
                },
                getChar: function(e) {
                    e = e || event;
                    if (e.which == null) {
                        if (e.keyCode < 32) return null;
                        return String.fromCharCode(e.keyCode);
                    }
                    if (e.which != 0 && e.charCode != 0) {
                        if (e.which < 32) return null;
                        return String.fromCharCode(e.which);
                    }
                    return null;
                },
                inArray: function(arr, val, f) {
                    var res;
                    if(typeof f !== 'string') f = false;
                    for(var i in arr) {
                        res = false;
                        if(f !== false) res = (arr[i][f] == val);
                        else res = (arr[i] == val);
                        if(res) return i;
                    }
                    return -1;
                },
                attach: function(elem, evType, fn) {
                    if (elem.addEventListener)
                        elem.addEventListener(evType, fn, false);
                    else if (elem.attachEvent)
                        //elem.attachEvent('on' + evType, fn)
                        elem.attachEvent("on"+evType, function(e) { return fn.apply(elem, [e]) })
                    else
                        elem['on' + evType] = fn
                }
            };

        }(window, jQuery));
    </script>

    <script type="text/javascript">
        var object = new jMovieShowing(document.getElementById('nodeShowing'), @json($prices));
        object.init();
    </script>
@endsection

