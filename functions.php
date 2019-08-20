<?php

function header_decorated(string $message) : string {
    $decoration_line = str_repeat('-=', strlen($message) / 2) . '-' . PHP_EOL;

    return
        $decoration_line
        . $message . PHP_EOL
        . $decoration_line;
}

function greeting() : string {
    return header_decorated('     My TODO list     ');
}

function red_line(string $message) : string {
    return "\e[0;31m{$message}\e[0m\n";
}