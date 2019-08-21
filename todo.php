<?php

/**
 * What our app must do?
 * - show help
 * - add, edit, remove tasks, instantly and interactively
 * - show all to-do list
 */

const DB = 'db/tasks.db';

require 'functions.php'; // https://www.php.net/manual/ru/function.require.php

echo greeting();

// Using nowdoc syntax - https://www.php.net/manual/ru/language.types.string.php
$help = <<<'HELP'

Usage: php todo.php [options] [command]

  php todo.php                                                      - show all tasks
  php todo.php --deadline=<datetime> add <task text>                - add new task
  php todo.php --deadline=<new datetime> edit <task id> <new text>  - edit task
  php todo.php del <task id>                                        - remove task
  php todo.php -i add                                               - interactive mode
  php todo.php --help                                               - show this help 

HELP;

$options = getopt('i', ['help', 'deadline:'], $optind); // https://www.php.net/manual/ru/function.getopt.php
if (isset($options['help'])) {
    echo $help;
    exit;
}

// var_dump($argv);

$command = $argv[$optind] ?? ''; // https://www.php.net/manual/ru/reserved.variables.argv.php

if ($command === '') {
    // This is 'show' command
    $tasks = read_tasks_from_file(DB);
    echo render_todo_list($tasks);
} elseif ($command === 'add') {
    if (isset($options['i'])) {
        echo 'Enter the task: ';
        $task_text = trim(fgets(STDIN));
        if (trim($task_text) === '') {
            echo red_line('Text can not be empty!');
            exit(1);
        }

        echo 'Enter the deadline: ';
        $deadline = trim(fgets(STDIN));
    } else {
        $task_text = $argv[$optind + 1] ?? '';
        // Validation.
        if ($task_text === '') {
            echo red_line('Please specify a text for "add" command');
            echo $help;
            exit(1);
        }

        $deadline = $options['deadline'] ?? '';
    }

    // php todo.php --deadline "2019-08-30 10:00:00" add "Поздравить маму с днём мамы"

    $task_id = get_next_task_id(read_tasks_from_file(DB));
    $task = [
        'id' => $task_id,
        'text' => $task_text,
        'deadline' => $deadline,
    ];
    save_task_to_file(DB, $task);

    echo 'Saved!' . PHP_EOL;
} else {
    echo red_line("[!!!] unknown command {$command}");
    echo $help;
}
