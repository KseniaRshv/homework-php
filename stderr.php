<?php

// Домашнее задание к занятию «1.2. Консольные приложения в PHP»
// Задание №2: создание консольного скрипта


echo "Введите первое число:\n";

do {
    $a = trim(fgets(STDIN));
    if (!ctype_digit($a)) {
        fwrite(STDERR, "Введите, пожалуйста, число\n");
    }
} while (!ctype_digit($a));

echo "Введите второе число:\n";

do {
    $b = trim(fgets(STDIN));
    
    if (!ctype_digit($b)) {
        fwrite(STDERR, "Введите, пожалуйста, число\n");
    } elseif ((int)$b === 0) {
        fwrite(STDERR, "Делить на 0 нельзя\n");
    }
} while (!ctype_digit($b) || (int)$b === 0);

fwrite(STDOUT, "Результат вычисления: " . ((int)$a / (int)$b) . "\n");