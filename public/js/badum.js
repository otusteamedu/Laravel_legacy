$(function() {

	$('.js-favorite').on('click', function () {
		$(this).toggleClass('active');
	});

	$('.js-tags div').on('click', function () {
		$('.hash-tags__item').removeClass('active');
		$(this).addClass('active');

		let tag = $(this).data('tag');
		const saleItem = $('.sale-item');

		saleItem.removeClass('hidden');
		if (tag !== 'all') {
			saleItem.addClass('hidden');
			$('.sale-item[data-tag-value="' + tag + '"]').removeClass('hidden');
		}

		let count = $('.sale-item.hidden').length;
		if ( count === 0 ) {
			$('.sale-list__btn').removeClass('hidden');
		} else {
			$('.sale-list__btn').addClass('hidden');
		}
	});

	const saleItemHidden = $('.sale-item.hidden');

	if ( !saleItemHidden ) return;
	let count = saleItemHidden.length;

	if ( count === 0 ) {
		$('.sale-list__btn').removeClass('hidden');
	}

	$('.js-modal').on('click', function () {
		$('#modal-promo').arcticmodal();
	});

	$('.js-question').on('click', function () {
		$('#modal-code-info').arcticmodal();
	});

	$('.js-tabs li').on('click', function () {
		$('.modal-tabs__links li').removeClass('active');
		$(this).addClass('active');

		let target = $(this).data('tab');
		$('.modal-tabs__content div').removeClass('active');
		$('#' + target).addClass('active');
	});

	$('.js-show-code').on('click', function () {
		$('.promocode__text').addClass('active');
		$('.js-show-code, .js-code, .js-copy-code').removeClass('hidden');
	});

	$('.js-copy-code').on('click', function () {
		//$('.js-code').select();
		document.execCommand("copy");
	});

	$('.js-login').on('click', function () {
		$('#modal-login').arcticmodal();
	});

	$("#phone").inputmask({"mask": "999 999 99 99"});

	$('.js-sms').on('click', function(){
		$('.modal-login').addClass('sms-result');
		$('#sms').focus();
	});

	$('.js-step-back').on('click', function () {
		$('.modal-login').removeClass('sms-result');
	})

});
