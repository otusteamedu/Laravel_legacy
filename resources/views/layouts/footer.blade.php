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
                        @lang('layouts/footer.contact_with_us'): <br>
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
                    <h4>@lang('layouts/footer.for_acquaintance')</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.about_project')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.events_list')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/news/">@lang('layouts/footer.project_news')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.articles')</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>@lang('layouts/footer.our_service')</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/personal/">@lang('layouts/footer.personal_cabinet')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.users_ratings')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.security_policy')</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">@lang('layouts/footer.feedbacks_about_us')</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h4>@lang('layouts/footer.subscribe')</h4>
                    <p>@lang('layouts/footer.subscribe_to_weekly_news')</p>
                    <form action="#" method="post">
                        <input type="email" name="email"><input type="submit" value="@lang('layouts/footer.subscribe')">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            © Copyright <strong><span>GeoCashing</span></strong>. @lang('layouts/footer.rights_reserved')
        </div>
        <div class="credits">
            @lang('layouts/footer.developed_by') <a href="https://codeblog.pro/">CodeBlog.pro</a>
        </div>
    </div>
</footer>

