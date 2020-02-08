<?php

if  (in_array  ('curl', get_loaded_extensions())) {

        echo "CURL is available on your web server";

    }  else {
        echo "CURL is not available on your web server";
    }
?>
