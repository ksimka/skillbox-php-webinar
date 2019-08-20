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

function read_tasks_from_file(string $path) : array {
    $tasks_lines = file($path); // https://www.php.net/manual/ru/function.file.php

    $tasks = [];
    foreach ($tasks_lines as $line) {
        $fields = explode('|', $line, 3);
        // var_dump($fields);

        $id = $fields[0];
        $tasks[$id] = [
            'id' => $id,
            'text' => $fields[1],
            'deadline' => new DateTimeImmutable($fields[2]),
        ];
    }

    return $tasks;
}