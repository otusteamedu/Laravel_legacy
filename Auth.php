<?php

namespace Auth;


class Auth
{

    function checkLogin()
    {
        if (!isset($_SESSION['antareit']['uid']))
            return false;
        else
            return true;
    }
}