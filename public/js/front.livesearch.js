/****
@since 1.2.0
***/
jQuery( document ).ready(function( $ ) {
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		}
	})();

	var searchRequest = false,
		enterActive = true;
	$('input[name="s"]').on("input", function() {
		var s = this.value;
		delay(function(){
		if( s.length <= 2 ) {
			$(dtGonza.area).hide();
			$(dtGonza.button).find('span').removeClass('icons-spinner9').removeClass('loading');
			return;
		}

		if(!searchRequest) {
			searchRequest = true;
			$(dtGonza.button).find('span').addClass('icons-spinner9').addClass('loading');
			$(dtGonza.area).find('ul').addClass('process').addClass('noselect');
			$.ajax({
		      type:'GET',
		      url: dtGonza.api,
		      data: 'keyword=' + s + '&sentence=1&nonce=' + dtGonza.nonce,
		      dataType: "json",
		      success: function(data){
				if( data['error'] ) {
					$(dtGonza.area).hide();
					return;
				}
				$(dtGonza.area).show();
					var res = '<span class="icon-search-1">' + s + '</span>',
						moreReplace = dtGonza.more.replace('%s', res),
						moreText = ''; 
						//'<li class="ctsx"><a class="more" href="javascript:;" onclick="document.getElementById(\'searchform\').submit();">' + moreReplace + '</a></li>';
						moreText2 = '<li class="ctsv"><a class="more" href="javascript:;" onclick="document.getElementById(\'form-search-resp\').submit();">' + moreReplace + '</a></li>';
					var items = [];
					$.each( data, function( key, val ) {
					  	name = '';
					  	date = '';
					  	imdb = '';
					  	if( val['extra']['date'] !== false )
					  		date = "<span class='release'>(" + val['extra']['date'] + ")</span>";

					  	if( val['extra']['imdb'] !== false )
					  		imdb = "<div class='imdb'><span class='icon-star'></span> " + val['extra']['imdb'] + "</div>";

					   	items.push("<li id='" + key + "'><a href='" + val['url'] + "' class='clearfix'><div class='poster'><img src='" + val['img'] + "' /></div><div class='title'>" + val['title'] + date + "</div>" + imdb + "</a></li>");
					});
					$(dtGonza.area).html('<ul>' + items.join("") + moreText + moreText2 +'</ul>');
				},
				complete: function() {
			      	searchRequest = false;
			      	enterActive = false;
					$(dtGonza.button).find('span').removeClass('icons-spinner9').removeClass('loading');
					$(dtGonza.area).find('ul').removeClass('process').removeClass('noselect');
				}
		   	});
		}
		}, 500 );
	});

	$(document).on("keypress", "#search-form", function(event) {
		if( enterActive ) {
			return event.keyCode != 13;
		}
	});

	$(document).click(function() {
		var target = $(event.target);
		if ($(event.target).closest('input[name="s"]').length == 0) {
			$(dtGonza.area).hide();
		} else {
			$(dtGonza.area).show();
		}

		if ($(event.target).closest('.lglossary').length == 0) {
			$('.items_glossary').hide();
			$('.lglossary').removeClass('active')
		} else {
			$('.items_glossary').show();
		}
	});

	// GET Data ( requests post )
	$('.post-request').click(function() {
		$('.post_request').show();
		$('#post_request_archive').html('<div class="load_event">' + dtAjax.loading + '</div>')
		var id = $(this).data('id');
		$.ajax({
			url: dtAjax.url,
			type: 'POST',
			data: {
				id: id,
				action: 'dbmovies_post_archive'
			},
			error: function(response) {
				console.log(response)
			},
			success: function(response) {
				$('#post_request_archive').html(response);
				$('.backdrop').click(function() {
					$('.post_request').hide()
				});
			},
		});
	});

	// Function Get_content
	function Get_content(id, type, nonce){
		$('#tmdb-'+ id ).html('<div class="itm-exists">'+ dtAjax.loading +'</div>');
		$.ajax({
			url: dtAjax.url,
			type: 'POST',
			data: {
				id: id,
				type: type,
				nonce: nonce,
				action: 'dbmovies_post_requests'
			},
			error: function(response) {
				console.log(response)
			},
			success: function(response) {
				console.log(response)
				$('#tmdb-'+ id ).html('<div class="itm-exists">'+ dtAjax.ready +'</div>');
			},
		});
	};

	// Function Search_content
	function Search_content() {
		var term	= $('#term').val()
		var page	= $('#page').val()
		var type	= $('#type').val()
		var nonce	= $('#nonce').val()
		var action	= $('#action').val()
		$('#get_requests').find('span').addClass('icons-spinner9').addClass('loading');
		$.ajax({
			url: dtAjax.url,
			type: 'POST',
			data: {
				type: type,
				term: term,
				page: page,
				nonce: nonce,
				action: action
			},
			error: function(response) {
				console.log(response)
			},
			success: function(response) {
				$('#get_requests').find('span').removeClass('icons-spinner9').removeClass('loading');
				$("#discover_results").html( response );
				$(".get_content_dbmovies").click(function(){
					var id 	= $(this).data('id');
					var type = $(this).data('type');
					var nonce = $(this).data('nonce');
					Get_content(id, type, nonce);
				});
			},
		});
	};

	// Live Search ( requests )
	$("#discover_requests").keyup(function(){
		delay(function () {
			Search_content();
		}, 500 );
		return false;
	});

	// Ajax Search ( Request )
	$("#discover_requests").submit(function() {
		Search_content();
		return false;
	});

    // Glosarry Ajax
    $(document).on('click', '.lglossary', function() {
        var term = $(this).data('glossary')
		var type = $(this).data('type')
        $('.lglossary').removeClass('active')
        $(this).addClass('active')
        $('.items_glossary').show()
        $('.items_glossary').html( '<div class="load"><i class="icons-spinner9 loading"></i></div>')
        $.ajax({
            type:'GET',
            url: dtGonza.glossary,
            data: 'action=search_live&term=' + term + '&nonce=' + dtGonza.nonce + '&type=' + type,
            dataType: "json",
            success: function(data){
                /*if( data['error'] ) {
					$('.items_glossary').hide()
                    $('.lglossary').removeClass('active')
					return;
				}*/
                $('.items_glossary').show();
                var items = [];
                $.each( data, function( key, val ) {
					imdb = '';
					if( val['imdb'] !== false )
						imdb = "<div class='rating'><i class='icon-star'></i> " + val['imdb'] + "</div>";

					items.push("<div id='" + key + "' class='item'><a href='" + val['url'] + "'><div class='poster'><img src='" + val['img'] + "' />"+ imdb +"</div></a><div class='data'><h3>" + val['title'] + '</h3><span>' + val['year'] + "</span></div></div>");
                });
				$('.items_glossary').html('<div class="items animation-2">' + items.join("") +'</div>');
            }
        });
    });

    // Keup
	$(document).keyup(function(e) {
		if(e.keyCode == 27) {
			$('.post_request').hide()
			$('.items_glossary').hide()
            $('.items_glossary').html(' ')
            $('.lglossary').removeClass('active')
		}
        if( e.keyCode == 39 ) {
            $("#nextpagination").trigger('click')
        }
        if( e.keyCode == 37 ) {
            $("#prevpagination").trigger('click')
        }
	});

	// End Scripts..
});
