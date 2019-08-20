<?php

function print_special(string $message, int $mode = 1) : string {
    if ($mode === 1) {
        $decorator = '-=';
    } else {
        $decorator = '\/';
    }
    $decoration_line = str_repeat($decorator, strlen($message) / 2) . '-' . PHP_EOL;

    return $decoration_line . $message . PHP_EOL . $decoration_line;
}

echo print_special('Hello, Skillbox', 2);

// Task with tail - '-'