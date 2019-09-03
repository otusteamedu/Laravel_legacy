<?php

function getSocketFilePath(): string {
    $filePath = __DIR__ . '/test.sock';
    return "unix://{$filePath}";
}

function getRandomMessage(): string {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, 10);
}
