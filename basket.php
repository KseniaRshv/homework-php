<?php

// Домашнее задание к занятию «2.1. Создание функций в PHP»
// Задание 2: рефакторинг кода
// Задание 3: улучшение менеджера списка покупок

declare(strict_types=1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;

// Для улучшения добавлена возможность изменять название товаров
const OPERATION_UPDATE = 4;


$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_UPDATE => OPERATION_UPDATE . '. Изменить название товара.',
];

$items = [];

function displayShoppingList(array $items): void {
    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        foreach ($items as $item => $quantity) {
            echo "$item: $quantity" . PHP_EOL;
        }
    } else {
        echo 'Ваш список покупок пуст.' . PHP_EOL;
    }
}

function getOperationNumber(array $operations): int {
    do {
        displayShoppingList($GLOBALS['items']);
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $operationNumber = (int)trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            system('clear');
            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }
    } while (!array_key_exists($operationNumber, $operations));

    return $operationNumber;
}

// Для улучшения добавлена возможность указания количества товара в функции
function addItem(array &$items): void {
    echo "Введите название товара для добавления в список: \n> ";
    $itemName = trim(fgets(STDIN));
    echo "Введите количество товара: \n> ";
    $quantity = (int)trim(fgets(STDIN));

    if (isset($items[$itemName])) {
        $items[$itemName] += $quantity;
    } else {
        $items[$itemName] = $quantity;
    }
}

function deleteItem(array &$items): void {
    if (empty($items)) {
        echo 'Список покупок пуст. Нечего удалять.' . PHP_EOL;
        return;
    }

    displayShoppingList($items);
    echo 'Введите название товара для удаления из списка:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    if (isset($items[$itemName])) {
        unset($items[$itemName]);
    } else {
        echo 'Товар не найден в списке.' . PHP_EOL;
    }
}

function updateItem(array &$items): void {
    if (empty($items)) {
        echo 'Список покупок пуст. Нечего изменять.' . PHP_EOL;
        return;
    }

    displayShoppingList($items);
    echo 'Введите название товара для изменения:' . PHP_EOL . '> ';
    $oldName = trim(fgets(STDIN));

    if (isset($items[$oldName])) {
        echo 'Введите новое название товара:' . PHP_EOL . '> ';
        $newName = trim(fgets(STDIN));
        $items[$newName] = $items[$oldName];
        unset($items[$oldName]);
    } else {
        echo 'Товар не найден в списке.' . PHP_EOL;
    }
}

function printItems(array $items): void {
    displayShoppingList($items);
    echo 'Всего ' . count($items) . ' позиций. ' . PHP_EOL;
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);
}

do {
    system('clear');
    $operationNumber = getOperationNumber($operations);

    echo 'Выбрана операция: ' . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            addItem($items);
            break;

        case OPERATION_DELETE:
            deleteItem($items);
            break;

        case OPERATION_PRINT:
            printItems($items);
            break;

        case OPERATION_UPDATE:
            updateItem($items);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;
?>