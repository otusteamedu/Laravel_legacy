@if (Request::url() !== 'http://otus')
</div>
<div class="col-lg-4">
    @include('layouts.blocks.content.sidebar')
</div>
</div>
@endif
</main>
<footer id="footer">
    <div class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>GeoCashing</h3>
                    <p>
                        С нами можно связаться: <br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>
                    <div class="social-links mt-3">
                        <a href="#">
                            <img ng-src="https://icomoon.io/icons5d33221/11/351.svg"
                                 src="https://icomoon.io/icons5d33221/11/351.svg">
                        </a>
                        <a href="#">
                            <img ng-src="https://icomoon.io/icons5d33221/11/359.svg"
                                 src="https://icomoon.io/icons5d33221/11/359.svg">
                        </a>
                        <a href="#">
                            <img ng-src="https://icomoon.io/icons5d33221/11/380.svg"
                                 src="https://icomoon.io/icons5d33221/11/380.svg">
                        </a>
                        <a href="#">
                            <img ng-src="https://icomoon.io/icons5d33221/13/557.svg"
                                 src="https://icomoon.io/icons5d33221/13/557.svg" width="20px" height="20px">
                        </a>
                        <a href="#">
                            <img ng-src="https://icomoon.io/icons5d33221/11/366.svg"
                                 src="https://icomoon.io/icons5d33221/11/366.svg">
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Ознакомьтесь</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">О проекте</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Список событий</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/news/">Новости проекта</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Полезные статьи</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Наш сервис</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/personal/">Личный кабинет</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Рейтинги участников</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Политика безопасности</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Отзывы о нас</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h4>Подписаться</h4>
                    <p>Вы можете подписаться на получение ежеденельных новостей</p>
                    <form action="#" method="post">
                        <input type="email" name="email"><input type="submit" value="Подписаться">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            © Copyright <strong><span>GeoCashing</span></strong>. Все права защищены
        </div>
        <div class="credits">
            Разработано <a href="https://codeblog.pro/">CodeBlog.pro</a>
        </div>
    </div>
</footer>

