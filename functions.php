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

        $id = trim($fields[0]);
        $tasks[$id] = [
            'id' => $id,
            'text' => trim($fields[1]),
            'deadline' => trim($fields[2]),
        ];
    }

    return $tasks;
}

function render_todo_list(array $tasks) : string {
    $header = 'id | task | deadline';
    $hrule = str_repeat('-', 30);

    $tasks_lines = [$header, $hrule];
    foreach ($tasks as $task) {
        $tasks_lines[] = "{$task['id']} | {$task['text']} | {$task['deadline']}";
        $tasks_lines[] = $hrule;
    }

    return implode(PHP_EOL, $tasks_lines) . PHP_EOL;
}

function get_next_task_id(array $tasks) : int {
    return max(array_column($tasks, 'id')) + 1;
}

function save_task_to_file(string $path, array $task) : void {
    $task_line = implode(' | ', $task) . PHP_EOL;
    $saved = file_put_contents($path, $task_line, FILE_APPEND);
    if ($saved === false) {
        throw new RuntimeException('failed to save task to file ' . $path);
    }
}