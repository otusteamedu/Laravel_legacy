<div class="hidden">
    <div class="box-modal box-modal--promo" id="modal-promo">
        <div class="box-modal-close arcticmodal-close"><img src="img/close-icon.svg" alt="Закрыть"></div>
        <div class="modal-header">
            <div class="modal-header__img" id="projectLogo"></div>
            <div class="modal-header__sale-info">
                <h2><span class="modal-header__caption" id="offerName"></span></h2>
                <div class="promocode">
                    <div class="promocode__text">
                        <input class="js-code hidden" id="offer-promo-code" type="text" value="bigsale03346667">
                        <div class="promocode__buttons">
                            <div class="promocode-btn js-show-code">Показать&nbsp;<span class="mobile-hidden">код</span></div>
                            <div class="promocode-btn js-copy-code hidden">Скопировать</div>
                        </div>
                    </div>
                </div>
                <div class="promocode-info">
                    <div class="promocode-info__code">Как активировать код<span class="js-question"><img src="img/question-icon.svg" alt=""></span></div>
                    <div class="promocode-info__date"><span class="mobile-hidden">Действует до</span><span class="mobile-visible">До</span> <span class="date">{{ \Carbon\Carbon::parse($offer->expiration_date)->format('d.m.Y')}}</span>
                    </div>
                </div>
                <div class="social-links" id="social-links"></div>
            </div>
        </div>
        <div class="modal-tabs">
            <ul class="modal-tabs__links js-tabs">
                <li class="active" data-tab="description">Описание</li>
                <li data-tab="conditions">Условия <span class="mobile-hidden">акции</span>
                </li>
                <li data-tab="places">Адреса</li>
            </ul>
            <div class="modal-tabs__content">
                <div class="active" id="description">

                </div>
                <div class="conditions" id="conditions">

                </div>
                <div class="places" id="places">
                    <div class="places__map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2001.9351069861582!2d30.42118931620956!3d59.88342667351328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46962fc7f3968075%3A0x89692e87338f00ae!2z0YPQuy4g0KHQtdC00L7QstCwLCA0OSwg0KHQsNC90LrRgi3Qn9C10YLQtdGA0LHRg9GA0LMsIDE5MjE0OA!5e0!3m2!1sru!2sru!4v1578928902338!5m2!1sru!2sru" width="100%" height="350" allowfullscreen=""></iframe>
                    </div>
                    <div class="places__info">
                        <div class="places__content" id="project-addresses">
                            <p><strong>Адреса:</strong></p>
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="places__social">
                            <p><strong>Поделиться в соц. сетях:</strong>
                            <div class="ya-share2" data-services="facebook,gplus,odnoklassniki,vkontakte"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-modal box-modal--activate" id="modal-code-info">
        <div class="box-modal-close arcticmodal-close"><img src="img/close-icon.svg" alt="Закрыть"></div>
        <div class="activate">
            <h2>Как активировать <span>промокод?</span>
            </h2>
            <p><strong>Чтобы активировать промокод Вам нужно проделать следующие шаги:</strong></p>
            <ol>
                <li>Нажать на кнопку “Скопировать” код</li>
                <li>Перейти на сайт партнера или в соц. сеть</li>
                <li>Выполнить описанные условия акции и ввести код или показать в магазине.</li>
            </ol>
            <p>Явные признаки победы институционализации заблокированы в рамках своих собственных рациональных ограничений. Сторонники тоталитаризма в науке формируют глобальную экономическую сеть и при этом - обнародованы. явные признаки победы институционализации заблокированы в рамках своих собственных рациональных ограничений. Сторонники тоталитаризма в науке формируют глобальную экономическую сеть и при этом - обнародованы</p>
        </div>
    </div>
    <div class="box-modal box-modal--login" id="modal-login">
        <div class="box-modal-close arcticmodal-close"><img src="img/close-icon.svg" alt="Закрыть"></div>
        <div class="modal-login">
            <form action="/">
                <div class="modal-login__step-1">
                    <h3>Войти в аккаунт<br>или создать профиль</h3>
                    <div class="modal-login__form">
                        <fieldset>
                            <label for="phone">Введите номер телефона</label>
                            <div class="form-box form-box--phone"><span>+7</span>
                                <input type="text" placeholder="___ ___ __ __" id="phone">
                            </div>
                        </fieldset>
                        <!--button(type="submit" class="bs-btn") Получить код в SMS--><span class="bs-btn js-sms">Получить код в SMS</span>
                    </div>
                </div>
                <div class="modal-login__step-2">
                    <div class="step-back js-step-back"></div>
                    <h3>Введите код из SMS</h3>
                    <div class="code-number">Код выслан на номер:&nbsp;<span>+7 (969) 567-34-22</span></div>
                    <div class="modal-login__form">
                        <fieldset>
                            <label for="sms">Введите код из SMS</label>
                            <div class="form-box form-box--sms">
                                <input type="text" id="sms">
                            </div>
                        </fieldset>
                        <div class="code-resending">Повторная отправка доступна через 00:56</div>
                        <button class="bs-btn bs-btn--disabled" type="submit" disabled>Отправить повторно SMS</button>
                    </div>
                </div>
                <div class="login-checkbox">
                    <input type="checkbox" id="agree" checked required>
                    <label for="agree">Согласен с условиями <a href="">Публичной&nbsp;оферты</a>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
