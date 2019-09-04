<?php

echo "hello word";

if (!extension_loaded('sockets')) {
    die('The sockets extension is not loaded.');
}else{
    echo "The sockets extension is loaded.";
}