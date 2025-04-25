<?php

// Домашнее задание к занятию «2.2. Основы работы с объектами»
// Задание 2: генератор расписания.

function generateSchedule($year, $month, $monthsCount = 1) {
    $currentMonth = $month;
    $currentYear = $year;
    $nextWorkingDay = 1; // Первый рабочий день

    for ($m = 0; $m < $monthsCount; $m++) {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $monthName = date('F', mktime(0, 0, 0, $currentMonth, 10));

        echo "Месяц: $monthName $currentYear\n";

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = mktime(0, 0, 0, $currentMonth, $day, $currentYear);
            $dayOfWeek = date('N', $date); // 1 (понедельник) - 7 (воскресенье)

            if ($day == $nextWorkingDay) {
                // Если рабочий день выпадает на выходные, переносим на понедельник
                if ($dayOfWeek == 6) { // Суббота
                    echo "\033[31m$day (перенос на понедельник)\033[0m\n";
                    $nextWorkingDay += 3; // Переносим на понедельник (через 3 дня)
                } elseif ($dayOfWeek == 7) { // Воскресенье
                    echo "\033[31m$day (перенос на понедельник)\033[0m\n";
                    $nextWorkingDay += 2; // Переносим на понедельник (через 2 дня)
                } else {
                    echo "\033[32m$day (рабочий)\033[0m\n";
                    $nextWorkingDay += 3; // Следующий рабочий день через 3 дня
                }
            } else {
                echo "$day\n";
            }
        }

        // Переход к следующему месяцу
        $currentMonth++;
        if ($currentMonth > 12) {
            $currentMonth = 1;
            $currentYear++;
        }
    }
}

// Пример вызова функции
generateSchedule(2025, 1, 3); // Сгенерируем расписание на январь, февраль и март 2025 года

?>