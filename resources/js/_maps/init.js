$(document).bind('ready', function() { return;
	var hDiv = document.body.appendChild(document.createElement('div')),
		hClose = hDiv.appendChild(document.createElement('a')),
		hContent = hDiv.appendChild(document.createElement('iframe'));
		
	hDiv.style.position = 'fixed';
	hDiv.style.zIndex = 9999;
	hDiv.style.top = '0px';
	hDiv.style.left = '0px';
	hDiv.style.width = '100%';
	hDiv.style.height = '100%';
	hDiv.style.display = 'none';
	hDiv.className = 'map-content-full';
	
	hClose.href = '#';
	hClose.innerHTML = 'Закрыть';
	hClose.className = 'exit';
	
	$('#service-menu .m-map a, .browse-type .i-map a, #map-line .i-block-more a, .map-link a, .bx-filter .i-map a').each(
		function() {
			var ha = this, url, hash, pos;
			url = ha.href;
			ha.onclick = function() {
				hDiv.style.display = 'block';
				Loading(hContent, {text:' ',opacity:0.8}).show();
				pos = url.indexOf('#');
				hash = '';
				if(pos>=0) {
					hash = url.substr(pos);
					url = url.substr(0, pos);
				}	
				url += (url.indexOf('?') >= 0) ? '&' : '?';
				url += 'show_map=Y';
				if(hash.length > 0) url += hash;
				
				$('html').addClass('pager-no-scroll');
				hContent.onload = function() {
					Loading(hContent).hide();
					//if(typeof(callback)=='function')
					//	callback.call(that);
				}
				hContent.src = url;
/*
				$.ajax({
					url: url,
					method: 'GET',
					success: function(html) {
						$(hContent).html(html);
						$(document).trigger('bx.ready', hContent);
					},
					dataType: 'html'
				});
*/
				return false;
			}
			hClose.onclick = function() {
				hDiv.style.display = 'none';
				hContent.innerHTML = '';
				$('html').removeClass('pager-no-scroll');
				return false;
			}
		}
	);
});