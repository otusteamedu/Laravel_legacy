mapLoader = function(node, params) {
	this.node = node;
	this.params = params || {};
	this.Map = null;
	this.clusterer = null;
	this.BalloonContentLayout = null;
	this.Data = [];
	this.isLoaded = false;
	this.timer = null;

	var that = this;
	ymaps.ready(function() {
		that.init();
	});
};
mapLoader.prototype.init = function()
{
	this.isLoaded = true;
	this.BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="map-ballon">'+
			'{% if properties.picture %}<div class="image"><img src="{{properties.picture}}" width="100" /></div>{% endif %}' +
			'<div class="desc">' +
				'{% if properties.name %}<div class="name">{{properties.name}}</div>{% endif %}' +
				'{% if properties.region and properties.district %}<div class="region">{{properties.region}}{% if properties.district %}, {{properties.district}}{% endif %}</div>{% endif %}' +
				'{% if properties.text %}<div class="text">{{properties.text}}</div>{% endif %}' +
				'<div class="button">Выбрать</div>' +
			'</div>' +
		'</div>', {
			build: function () {
				// Вызываем родительский метод build.
				this.constructor.superclass.build.call(this);
				$('.button', this.getParentElement()).
					on('click', $.proxy(this.onSelect, this));
			},
            clear: function () {
                $('.button', this.getParentElement()).off('click');
				this.constructor.superclass.clear.call(this);
            },

			onSelect: function (e) {
                e.preventDefault();
				var loader = this.getData().properties.get('loader');
				if(typeof loader.params.onSelect == 'function')
					loader.params.onSelect.apply(loader, [this.getData().properties.getAll()]);
            }
		}
	);

	this.Map = new ymaps.Map("mapElement", {
		center: [55.76, 37.64],
		zoom: 10,
		scrollZoom: false,
		ruler: false,
		controls: ['zoomControl']
	}, {preset:"islands#darkGreenCircleIcon"});

	this.Map.setType('yandex#publicMap');
	this.clusterer = new ymaps.Clusterer({
		preset:'islands#darkOrangeCircleIcon',
		gridSize: 40,
		clusterBalloonItemContentLayout: this.BalloonContentLayout,
	});
	this.Map.geoObjects.add(this.clusterer);
		//myMap.controls.get("searchControl").options.set('noPlacemark',true);
		//myMap.controls.remove(sc);
		//sc.options.noPlacemark=true;
		//myMap.controls.add(sc);

	//	Loading(this.node).show();
	//	Loading(this.node).hide();
};

mapLoader.prototype.delegate = function (func)
{
	var thisObject = this;
	return function() {
		return func.apply(thisObject, arguments);
	}
};
mapLoader.prototype.loadList = function(url, currentPointId) {
	this.load('list', {urlData: url, currentId: currentPointId}, this.delegate(this.setObjects));
};

mapLoader.prototype.load = function(cmd, params, callback) {
	params = params || {};
	var i, that = this, url, d;

	if(this.timer != null) {
		clearTimeout(this.timer);
		this.timer = null;
	}
	if(this.isLoaded) {
		url = params.urlData || this.params.urlData || window.location.href;
		d = (url.indexOf('?') < 0) ? '?' : '&'
		cmd = cmd || 'list';
		url += d + 'cmd=' + cmd;
		url += '&ajax_map=Y';
		for(i in params)
			url += '&' + i + '=' + params[i];

		//Loading(that.node).show();
		$.ajax({
			url:url,
			type: "GET",
			success: function(data) {
				callback(data, params.currentId);
			//	Loading(that.node).hide();
			},
			dataType: 'json'
		});
	}
	else {
		this.timer = setTimeout(function() {
			that.timer = null;
			that.load.apply(that, [cmd, params, callback]);
		}, 200);
	}
};
mapLoader.prototype.setObjects = function(data, currentId) {
	var obj, i;
	this.removeAll();

	this.Data = data;
	for(i in this.Data) {
		obj = this.Data[i];
		this.Data[i].object = this.createPoint(obj);
		if(!this.clusterer)
			this.Map.geoObjects.add(this.Data[i].object);
	}
	obj = [];
	for(i in this.Data)
		obj[obj.length] = this.Data[i].object;

	this.clusterer.add(obj);
	if(this.Data.length > 0) {
		this.setMapBounds(currentId);
	}
};
mapLoader.prototype.createPoint = function(data) {
	var placeMark, that = this;
	placeMark = new ymaps.Placemark([data.location[0], data.location[1]], {
		name: data.name,
		image: '',
		url: '',
		properties: [],
        text: "Идет загрузка данных...",
		balloonContentHeader: data.name,
		clusterCaption: data.name
    }, {
		balloonContentLayout: this.BalloonContentLayout,
		balloonPanelMaxMapArea: 0,
		preset: "islands#dotCircleIcon"
	});

	placeMark.properties.set('id', data.id);
	placeMark.properties.set('loader', this);

	placeMark.events.add('balloonopen', function (e)
	{
		var value = placeMark.properties.get('id');
		that.load('item', {id: value}, function(data) {
			for(var key in data)
				placeMark.properties.set(key, data[key]);
		});
	});

	return placeMark;
};
mapLoader.prototype.removeAll = function() {
	var i;
	if(this.clusterer)
		this.clusterer.removeAll();
	else {
		for(i in this.Data)
			this.Map.geoObjects.remove(this.Data[i].object);
	}
	this.Data = [];
};
//clusterer.remove(placemarks.slice(0, 10));
mapLoader.prototype.setMapBounds = function(id) {
	var that = this;
	if(this.clusterer && !id) {
		this.Map.setBounds(this.clusterer.getBounds(), {
			checkZoomRange: true
		});
	}
	else {
		if((typeof(id) != 'undefined')) {
			var object = this.findObj(id), location;
			if(object) {
                location = object.location;
				//that.Map.zoomRange.get(location).then(function(res)
				//{
				//	 that.Map.setCenter(location, res[1]);
				//});
				//object.object.balloon.open();
				that.Map.setCenter(location, 18);
			}
		}
		else if(this.Data.length == 1) {
            location = this.Data[0].location;
			this.Map.setCenter(location);
		}
		else {
			var min = [0, 0], max = [0, 0];
			for(var i = 0; i < this.Data.length; i++) {
                location = this.Data[i].location;
				if(	(typeof(location[0]) == 'undefined') ||
					(typeof(location[1]) == 'undefined'))
					continue;

				if(!min[0] || (location[0]<min[0])) min[0] = location[0];
				if(!min[1] || (location[1]<min[1])) min[1] = location[1];

				if(!max[0] || (location[0]>max[0])) max[0] = location[0];
				if(!max[1] || (location[1]>max[1])) max[1] = location[1];
			}

			this.Map.setBounds(min, max);
		}
	}
};
mapLoader._find = function(haystack, filter) {
	var res = [], i, j, val, found;
	if(typeof filter == 'string' || typeof filter == 'number')
		filter = {ID: filter};
	for(i in haystack) {
		val = haystack[i];
		found = true;
		for(j in filter)
		if((typeof val[j]=='undefined')||(val[j]!=filter[j])) {
			found = false;
			break
		}
		if(found) res[res.length] = i;
	}
	return res;
};
mapLoader.base64_decode = function( data ) {
	var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var o1, o2, o3, h1, h2, h3, h4, bits, i=0, enc='';

	do {
		h1 = b64.indexOf(data.charAt(i++));
		h2 = b64.indexOf(data.charAt(i++));
		h3 = b64.indexOf(data.charAt(i++));
		h4 = b64.indexOf(data.charAt(i++));

		bits = h1<<18 | h2<<12 | h3<<6 | h4;

		o1 = bits>>16 & 0xff;
		o2 = bits>>8 & 0xff;
		o3 = bits & 0xff;

		if (h3 == 64) enc += String.fromCharCode(o1);
		else if (h4 == 64) enc += String.fromCharCode(o1, o2);
		else enc += String.fromCharCode(o1, o2, o3);
	} while (i < data.length);

	return mapLoader.utf8(enc);
};
mapLoader.utf8 = function(utftext) {
	var string = "";
	var i = 0;
	var c = c1 = c2 = 0;

	while ( i < utftext.length ) {
		c = utftext.charCodeAt(i);
		if (c < 128) {
			string += String.fromCharCode(c);
			i++;
		} else if((c > 191) && (c < 224)) {
			c2 = utftext.charCodeAt(i+1);
			string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
			i += 2;
		} else {
			c2 = utftext.charCodeAt(i+1);
			c3 = utftext.charCodeAt(i+2);
			string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
			i += 3;
		}
	}

	return string;
};
mapLoader.prototype.find = function(filter) {
	return mapLoader._find(this.Data, filter);
};
mapLoader.prototype.findObjs = function(filter) {
	var result = [], i, r;
	r = this.find(filter);
	for(i in r)
		result[result.length] = this.Data[r[i]];
	return result;
};
mapLoader.prototype.findObj = function(filter) {
	var r = this.find(filter);
	return r.length ? this.Data[r[0]] : null;
};
