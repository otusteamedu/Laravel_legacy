<div class="login_box">
    <div class="box">
         <a id="c_loginbox"><i class="icon-close2"></i></a>
         <h3>@lang('messages.Login') </h3>
         <form method="post" id="dooplay_login_user">
            <fieldset class="user">
                 <input type="text" name="log" placeholder="@lang('messages.username')">
            </fieldset>
            <fieldset class="password">
                <input type="password" name="pwd" placeholder="@lang('messages.password')">
            </fieldset>
            <label>
                <input name="rmb" type="checkbox" id="rememberme" value="forever" checked=""> @lang('messages.remember')
            </label>
            <fieldset class="submit">
                <input id="dooplay_login_btn" data-btntext="Log in" type="submit" value="Log in">
            </fieldset>
            <a class="register" href="https://demo.ews.pe/dooplay/account/?action=sign-in">Register a new account</a>
            <label>
                <a class="pteks" href="https://demo.ews.pe/dooplay/wp-login.php?action=lostpassword">Lost your password?</a>
            </label>
            <input type="hidden" name="red" value="https://demo.ews.pe/dooplay/contact/">
            <input type="hidden" name="action" value="dooplay_login">
        </form>
    </div>
</div>
