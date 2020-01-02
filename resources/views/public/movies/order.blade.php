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
        <div class="container-fluid order-ticket i-iblock">
            <div class="row align-items-start m-0">
                <div class="col-md-6">
                    <h5><b>Фильм</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Название:</b></td>
                            <td>{{ $movie['name'] }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Длительность:</b></td>
                            <td>{{ $movie['duration'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>Место</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Кинотеатр:</b></td>
                            <td>{{ $hall['cinema']['name'] }}. Зал: №{{ $hall['number'] }}&nbsp;&laquo;{{ $hall['name'] }}&raquo;</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Адрес:</b></td>
                            <td>{{ $hall['cinema']['address'] }}</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>Сеанс</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Дата:</b></td>
                            <td>{{ $showing['date'] }}</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>&nbsp;</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Время:</b></td>
                            <td>{{ $showing['time'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
            </div>
            <div class="row align-items-start m-0">
                <div class="col-md-6">
                    <div data-role="hall" class="hall-area">
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
                </div>
                <div class="col-md-6">
                    <h6>Выберите места и нажмите кнопку заказать</h6>
                    <div class="message-status" data-role="message"></div>
                    <div class="places-selected" data-role="order">
                        <ul data-role="items" class="clearfix"></ul>
                        <input data-role="checkout" type="submit" class="btn btn-success shadow" value="Заказать" />
                    </div>
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
            var MovieShowing = function(node, prices, params) {
                this.node = node;
                this.params = params;

                this.data = Util.getOpts(node, {}, 'showing');
                this.hall = null;
                this.order = null;
                this.message = null;

                this.prices = prices;
            };
            MovieShowing.prototype.init = function() {
                var node, that = this;

                node = Util.FindRole('hall', this.node);
                if(node.length > 0) {
                    this.hall = new Hall(node[0], this);
                    this.hall.init();
                }
                node = Util.FindRole('order', this.node);
                if(node.length > 0) {
                    this.order = new Order(node[0], this);
                    this.order.init();
                }
                node = Util.FindRole('message', this.node);
                if(node.length > 0) {
                    this.message = new Message(node[0], this);
                    this.message.init();
                }

                this.update();
            };
            MovieShowing.prototype.update = function() {
                var that = this;
                if(!that.hall)
                    return;

                this.hall.loadTickets(function() {
                    if(!that.order)
                        return;
                    that.order.loadOrder(function() {
                        that.order.update();
                        that.hall.update();
                    });
                });
            };
            MovieShowing.prototype.fallback = function() {

            };

            var Message = function(node) {
                this.node = node;
                this.timeout = null;
            };
            Message.prototype.init = function() {
                this.clean();
            };
            Message.prototype.clean = function() {
                //this.node.innerHTML = '&nbsp;';
                this.node.className = 'message-status';
            };
            Message.prototype.text = function(value, type) {
                if(type == 'error')
                    this.node.innerHTML = '<div class="bg-danger text-white">' + value + '</div>';
                else
                    this.node.innerHTML = '<div class="bg-success text-white">' + value + '</div>';
                this.node.className = 'message-status showed';
            };
            Message.prototype.flash = function(data) {
                var type, message, that = this;
                if(!data.status) {
                    type = 'error';
                    message = data.toString();
                }
                else {
                    type = data.status.toLowerCase();
                    message = data.message
                }
                if('errorsuccess'.indexOf(type) < 0)
                    type = 'error';

                if(this.timeout) {
                    clearTimeout(this.timeout);
                    this.timeout = null;
                }
                this.text(message, type);
                setTimeout(function() {
                    that.clean();
                    that.timeout = null;
                }, 4000);
            };

            var Order = function(node, parent) {
                this.node = node;
                this.parent = parent;

                this.nodeButton = null;
                this.nodeList = null;
                this.nodeCount = null;
                this.nodeTotal = null;

                this.query = new Query();
                this.data = null;
                this.items = [];
            };
            Order.prototype.init = function() {
                var that = this, node;
                node = Util.FindRole('items', this.node);
                this.show(false);
                if(node.length > 0)
                    this.nodeList = node[0];

                node = Util.FindRole('checkout', this.node);
                if(node.length > 0) {
                    this.nodeButton = node[0];
                    this.nodeButton.onclick = function() {
                        that.checkout();
                        return false;
                    }
                }
            };
            Order.prototype.checkout = function() {
                if(this.data.total > 0)
                    location.href = this.parent.params.urlOrder.checkout;
            };
            Order.prototype.clearOrder = function() {
                var i, n = this.items.length;
                for(i = n - 1; i >= 0; i--) {
                    this.removeItem(i);
                }
                this.items = [];
            };
            Order.prototype.removeItem = function(index) {
                var item = this.items[index];
                this.nodeList.removeChild(item.node);
                this.items.splice(index, 1);
            };
            Order.prototype.initOrder = function() {
                var i, item, li;
                this.clearOrder();
                if(this.data.total > 0) {
                    this.show(true);
                    for(i in this.data.items) {
                        item = new OrderItem(
                            this.nodeList.appendChild(document.createElement('li')),
                            this,
                            this.data.items[i]
                        );
                        item.init();
                        this.items[this.items.length] = item;
                    }
                }
                else {
                    this.show(false);
                }
            };
            Order.prototype.show = function(bShow) {
                bShow = bShow || false;
                this.node.style.display = bShow ? '' : 'none';
            };
            Order.prototype.update = function() {
                this.initOrder();
            };
            Order.prototype.loadOrder = function(callback) {
                var that = this,
                    queryUrl = this.parent.params.urlOrder.list;

                this.query.get(queryUrl, null, 'get').success(
                    function (data) {
                        that.data = data;
                        if(typeof callback == 'function')
                            callback.apply(that);
                    }
                ).error(
                    function() {parent
                        that.parent.fallback.apply(that);
                    }
                ).spinOn(this.node);
            };
            Order.prototype.addPlace = function(place, callback) {
                var that = this,
                    shwg = this.parent,
                    queryUrl = shwg.params.urlOrder.add;

                this.query.get(
                    queryUrl, {
                        showing_movie_id: this.parent.data.id,
                        place_id: place.id
                    }, 'get').success(
                    function (data) {
                        shwg.message.flash(data);
                        shwg.update();
                        if(typeof callback == 'function')
                            callback.apply(that, [data]);
                    }
                ).error(
                    function() {
                        that.parent.fallback.apply(that);
                    }
                ).spinOn(place.parent.node);
            };
            Order.prototype.removePlace = function(place, callback) {
                var that = this,
                    shwg = this.parent,
                    queryUrl = shwg.params.urlOrder.remove;

                this.query.get(
                    queryUrl, {
                        showing_movie_id: this.parent.data.id,
                        place_id: place.id
                    }, 'get').success(
                    function (data) {
                        shwg.message.flash(data);
                        shwg.update();
                        if(typeof callback == 'function')
                            callback.apply(that, [data]);
                    }
                ).error(
                    function() {
                        that.parent.fallback.apply(that);
                    }
                ).spinOn(place.parent.node);
            };
            Order.prototype.removeOrderItem = function(item, callback) {
                var that = this,
                    shwg = this.parent,
                    queryUrl = shwg.params.urlOrder.removeitem;

                this.query.get(
                    queryUrl, {
                        item_id: item.data.id
                    }, 'get').success(
                    function (data) {
                        shwg.message.flash(data);
                        shwg.update();
                        if(typeof callback == 'function')
                            callback.apply(that, [data]);
                    }
                ).error(
                    function() {
                        that.parent.fallback.apply(that);
                    }
                ).spinOn(this.node);
            };
            var OrderItem = function(node, parent, data) {
                this.node = node;
                this.parent = parent;
                this.data = data;
            };
            OrderItem.prototype.init = function() {
                var node, i, that = this;
                this.node.innerHTML = this.getContent(this.data);
                node = Util.FindRole('item-delete', this.node);
                if(node.length > 0) {
                    node = node[0];
                    node.onclick = function() {
                        that.clickDetele();
                        return false;
                    }
                }
            };
            OrderItem.prototype.clickDetele = function() {
                this.parent.removeOrderItem(this);
            };
            OrderItem.prototype.getContent = function(itemData) {
                var available = !!parseInt(itemData.available),
                    msg = this.parent.parent.params.messages;

                return '<div class="ticket-wrapper status-' + (available ? 'enabled' : 'disabled') + '">'+
                    '<span data-role="item-delete" class="ticket-delete"><i class="fas fa-times-circle" aria-hidden="true"></i></span>' +
                    '<div class="ticket-content">'+
                    '<div class="ticket-place">' + itemData.description.place.value + '</div>' +
                    '<div class="ticket-price">' + itemData.price + '&nbsp;руб.</div>' +
                    '<div class="ticket-status">' + (available ? msg.ticketStatusEnabled : msg.ticketStatusDisabled) + '</div>' +
                    '</div>' +
                    '</div>';
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

                this.data = [];
                this.query = new Query();
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
            Hall.prototype.loadTickets = function(callback) {
                var that = this,
                    queryUrl = this.parent.params.urlTicket.list;

                this.query.get(queryUrl, {showing_movie_id: this.parent.data.id}, 'get').success(
                    function (data) {
                        that.data = data;
                        if(typeof callback == 'function')
                            callback.apply(that);
                    }
                ).error(
                    function() {
                        that.parent.fallback.apply(that);
                    }
                ).spinOn(this.node);
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
                var statusMap = [], i, key, item, available,
                    oData = this.parent.order.data;
                for(i = 0; i < this.data.length; i++) {
                    item = this.data[i];
                    key = item.movie_showing_id + ':' + item.place_id;
                    statusMap[key] = item.id;
                }
                for(i = 0; i < oData.items.length; i++) {
                    item = oData.items[i].ticket;
                    if(!item)
                        continue;
                    available = parseInt(oData.items[i].available);
                    if(!available)
                        continue;
                    key = item.movie_showing_id + ':' + item.place_id;
                    statusMap[key] = 0;
                }

                for(i = 0; i < this.places.length; i++) {
                    item = this.places[i];
                    key = this.parent.data.id + ':' + item.id;
                    this.places[i].disabled = false;
                    this.places[i].selected = false;
                    if(typeof statusMap[key] != 'undefined') {
                        if(statusMap[key])
                            this.places[i].disabled = true;
                        else
                            this.places[i].selected = true;
                    }
                    this.places[i].update();
                }
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

                this.disabled = false;
                this.selected = false;
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
                var that = this;
                if(this.disabled)
                    return;

                if(this.selected) {
                    this.showing().order.removePlace(this, function() {
                        that.selected = false;
                    });
                }
                else {
                    this.showing().order.addPlace(this, function() {
                        that.selected = true;
                    });
                }
            };
            Place.prototype.showing = function() {
                return this.parent.parent;
            };
            Place.prototype.update = function() {
                var className = 'place';
                if(this.disabled)
                    className += ' place-disabled';
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
            };

            w.jMovieShowing = MovieShowing;

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
                        elem.attachEvent("on" + evType, function(e) { return fn.apply(elem, [e]) })
                    else
                        elem['on' + evType] = fn
                },
                // получить связанный объект
                _allNodes: [],
                get_node: function(creator, node) {
                    var n = this._allNodes.length, i, factory;
                    for(i = 0; i < n; i++)
                        if((node == this._allNodes[i].node)
                            && (this._allNodes[i].constructor == creator))
                            return this._allNodes[i];
                    factory = creator.bind.apply(
                        creator,
                        [null].concat(Array.prototype.slice.call(arguments, 1))
                    );
                    this._allNodes[n] = new factory();
                    return this._allNodes[n];
                }
            };

            // method
            /*
            var Query = function(node, url, params, method) {
                node = typeof(node)=='string' ? document.getElementById(node) : node;
                node = node || document.body;
                return Util.get_node(_Query, node, url, params, method);
            };
            */
            var Query = function() {
                this.handle = null;
                this.nodeWait = null;

                this.fnError = null;
                this.fnSuccess = null;
                this.target = null;

                // this.reset();
            };
            Query.prototype.reset = function() {
                this.fnError = null;
                this.fnSuccess = null;
                this.target = null;
            };
            Query.prototype.isHolded = function() {
                return (this.handle != null);
            };
            Query.prototype.error = function(fnError) {
                this.fnError = fnError;
                return this;
            };
            Query.prototype.success = function(fnSuccess) {
                this.fnSuccess = fnSuccess;
                return this;
            };
            Query.prototype.spinOn = function(target) {
                this.target = target;
                return this;
            };
            Query.prototype.wait = function(bShow) {
                if(bShow) {
                    if(!this.target)
                        return;
                    if(!this.nodeWait) {
                        this.nodeWait = this.target.appendChild(
                            document.createElement('div')
                        );
                        this.nodeWait.className = 'loading-layer';

                        this.nodeWait.style.position = 'absolute';
                        this.nodeWait.style.top = '0px';
                        this.nodeWait.style.right = '0px';
                        this.nodeWait.style.bottom = '0px';
                        this.nodeWait.style.left = '0px';
                        this.nodeWait.style.width = '100%';
                        this.nodeWait.style.height = '100%';

                        this.nodeWait.innerHTML = '<div class="d-table-cell" style="text-align:center;vertical-align:middle">' +
                            '<div class="spinner-border" role="status">' +
                            '<span class="sr-only">Loading...</span>' +
                            '</div>' +
                            '</div>';
                    }
                }
                else {
                    if(this.nodeWait) {
                        this.nodeWait.parentNode.removeChild(this.nodeWait);
                        this.nodeWait = null;
                    }
                }
            };
            Query.prototype.close = function(callback, data) {
                this.wait(false);
                this.handle = null;
                if(typeof callback == 'function')
                {
                    if(data !== null)
                        callback.apply(this, [data]);
                    else
                        callback.apply(this);
                }
            };
            Query.prototype.getUrl = function(queryUrl, params) {
                var parts = [];
                for(var i in params)
                    parts[parts.length] = i + '=' + params[i];
                queryUrl += ((queryUrl.indexOf('?') >= 0) ? '&' : '?');
                queryUrl += parts.join('&');

                return queryUrl;
            };
            Query.prototype.get = function(url, params, method) {
                var that = this;
                if(that.isHolded())
                    return;

                that.reset();
                setTimeout(function () {
                    that.wait(true);
                    params = params || {};
                    method = (method || 'GET').toUpperCase();
                    if('GETPOSTPATCHPUTDELETE'.indexOf(method) < 0)
                        method = 'GET';

                    that.handle = $.ajax({
                        url: that.getUrl(url, params),
                        method: method,
                        success: function(data) {
                            that.close(that.fnSuccess, data);
                        },
                        error: function() {
                            that.close(that.fnError, null);
                        },
                        dataType: 'json'
                    });
                }, 100);

                return this;
            };
        }(window, jQuery));
    </script>

    <script type="text/javascript">
        var object = new jMovieShowing(document.getElementById('nodeShowing'), @json($prices), {
            urlOrder: {
                list: "{{ route('public.order.getsession') }}",
                add: "{{ route('public.order.addticket') }}",
                remove: "{{ route('public.order.removeticket') }}",
                removeitem: "{{ route('public.order.removeitem') }}",
                checkout: "{{ route('public.order.checkout') }}"
            },
            urlTicket: {
                list: "{{ route('public.movies.showing.tickets') }}"
            },
            messages: {
                ticketStatusEnabled: "{{ __('public.order.ticketStatusEnabled') }}",
                ticketStatusDisabled: "{{ __('public.order.ticketStatusDisabled') }}"
            }
        });
        object.init();
    </script>

@endsection

