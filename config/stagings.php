<?php
$file =__DIR__ . '/../stagings.json';
if (file_exists($file)) {
    return json_decode(file_get_contents($file), true);
}

return [];