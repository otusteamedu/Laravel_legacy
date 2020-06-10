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
        document.getElementsByClassName('modal-header__caption').innerHTML = 'skdjflskdf';

        $.get('api/offers/' + this.dataset.id, function (data) {
            let offerName = document.getElementById('offerName');
            let offerCondition = document.getElementById('conditions');

            let projectLogo = document.getElementById('projectLogo');
            let projectDescription = document.getElementById('description');
            let projectAddresses = document.getElementById('project-addresses');
            let projectSocialLinks = document.getElementById('social-links');
            let offerPromoCode = document.getElementById('offer-promo-code');

            offerName.innerHTML = data.attributes.offer.name;
            offerCondition.textContent = data.attributes.offer.description;

            projectLogo.innerHTML = '<img src="' + data.attributes.project.logo_path + '" alt="">';
            projectDescription.textContent = data.attributes.project.description;

            let socialLinks = '';
            if (data.attributes.project.instagram !== null) socialLinks = socialLinks + '<a class="social-links__item" href="' + data.attributes.project.instagram + '" target="_blank"><img src="img/ic-insta.svg" alt=""> ' + data.attributes.project.instagram + '</a>'
            if (data.attributes.project.vk !== null) socialLinks = socialLinks + '<a class="social-links__item" href="' + data.attributes.project.vk + '" target="_blank"><img src="img/vk-icon-2.svg" alt="">' + data.attributes.project.vk + '</a>';
            if (data.attributes.project.website !== null) socialLinks = socialLinks + '<a class="social-links__item" href="' + data.attributes.project.website + '" target="_blank"><img src="img/globe-icon.svg" alt="">' + data.attributes.project.website + '</a>';
            projectSocialLinks.innerHTML = socialLinks;

            let addresses = "<p><strong>Адреса:</strong></p>";
            addresses = addresses + "<ul>";
            if (data.attributes.project.address1 !== null) addresses = addresses + "<li>" + data.attributes.project.address1 + "</li>";
            if (data.attributes.project.address2 !== null) addresses = addresses + "<li>" + data.attributes.project.address2 + "</li>";
            if (data.attributes.project.address3 !== null) addresses = addresses + "<li>" + data.attributes.project.address3 + "</li>";
            addresses = addresses + "</ul>"
            addresses = addresses + '<div>' + data.attributes.project.contact_data + '</div>';
            projectAddresses.innerHTML = addresses;

            offerPromoCode.value = data.attributes.offer.promo_code;
        });

        // TODO разложи красиво все данные на форме попапа
        //console.log(captionOffer.childNodes);
        //captionOffer.textContent = data.attributes.name;
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
