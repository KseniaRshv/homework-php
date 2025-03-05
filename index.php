<?php
// Запрос данных от пользователя
$lastname = trim(readline("Введите фамилию: "));
$firstname = trim(readline("Введите имя: "));
$middlename = trim(readline("Введите отчество: "));

// Функция для приведения строки к формату "Первая буква заглавная, остальные строчные"
function mb_ucfirst($string) {
    return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
}

// Приведение имени, фамилии и отчества к нужному формату
$lastname = mb_ucfirst(mb_strtolower($lastname));
$firstname = mb_ucfirst(mb_strtolower($firstname));
$middlename = mb_ucfirst(mb_strtolower($middlename));

// Полное имя
$fullName = "$lastname $firstname $middlename";

// Фамилия и инициалы
$surnameAndInitials = "$lastname " . mb_substr($firstname, 0, 1) . "." . mb_substr($middlename, 0, 1) . ".";

// Аббревиатура
$fio = mb_substr($lastname, 0, 1) . mb_substr($firstname, 0, 1) . mb_substr($middlename, 0, 1);

// Вывод результатов
echo "Полное имя: '$fullName'\n";
echo "Фамилия и инициалы: '$surnameAndInitials'\n";
echo "Аббревиатура: '$fio'\n";