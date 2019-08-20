<?php

// No variable definition - set the value right away.
$sum42 = 2 + 40;

var_dump($sum42);

// Strings can be enclosed with "" or ''.
$first_string = "Hello";
$second_string = 'Skillbox';

// Concatenation.
$hello = $first_string . ', ' . $second_string;

// One-line comment.

/*
 * Multi-line comment.
 * Here it is.
 */

// Function definition.
function print_special(string $message) : void
{
    echo '-=-=-=-=-=-=-=-=-=-=-' . PHP_EOL;
    echo $message . PHP_EOL;
    echo '-=-=-=-=-=-=-=-=-=-=-' . PHP_EOL;
}

// Function call.
print_special($hello);

function print_special2(string $message) : void
{
    echo str_repeat('-=', strlen($message) / 2) . '-' . PHP_EOL;
    echo $message . PHP_EOL;
    echo str_repeat('-=', strlen($message) / 2) . '-' . PHP_EOL;
}

print_special2($hello);