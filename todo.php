<?php

/**
 * What our app must do?
 * - show help
 * - add, edit, remove tasks, instantly and interactively
 * - show all to-do list
 */

require 'functions.php'; // https://www.php.net/manual/ru/function.require.php

echo greeting();

// Using nowdoc syntax - https://www.php.net/manual/ru/language.types.string.php
$help = <<<'HELP'

Usage: php todo.php [command] [options]

  php todo.php                                                     - show all tasks
  php todo.php add <task text> --do-till=<datetime>                - add new task
  php todo.php edit <task id> <new text> --do-till=<new datetime>  - edit task
  php todo.php del <task id>                                       - remove task
  php todo.php -i                                                  - interactive mode
  php todo.php --help                                              - show this help 

HELP;

$options = getopt('', ['help']); // https://www.php.net/manual/ru/function.getopt.php
if (isset($options['help'])) {
    echo $help;
    exit;
}

// var_dump($argv);

$command = $argv[1] ?? ''; // https://www.php.net/manual/ru/reserved.variables.argv.php

if ($command === '') {
    // This is 'show' command
    $tasks = read_tasks_from_file('db/tasks.db');
    echo render_todo_list($tasks);
} elseif ($command === 'add') {
    echo 'this is ADD command' . PHP_EOL;
} else {
    echo red_line("[!!!] unknown command {$command}");
    echo $help;
}
