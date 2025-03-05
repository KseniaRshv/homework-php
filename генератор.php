<?php

// Домашнее задание к занятию «2.2. Основы работы с объектами»
// Задание 2: генератор расписания.

function generateSchedule($year, $month, $monthsCount = 1) {
    $currentMonth = $month;
    $currentYear = $year;
    $isWorkingDay = true; // Первое число месяца - рабочий день

    for ($m = 0; $m < $monthsCount; $m++) {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $monthName = date('F', mktime(0, 0, 0, $currentMonth, 10));

        echo "Месяц: $monthName $currentYear\n";

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = mktime(0, 0, 0, $currentMonth, $day, $currentYear);
            $dayOfWeek = date('N', $date); // 1 (понедельник) - 7 (воскресенье)

            if ($isWorkingDay) {
                // Если рабочий день выпадает на выходные, переносим на понедельник
                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    echo "\033[31m$day (перенос на понедельник)\033[0m\n";
                } else {
                    echo "\033[32m$day (рабочий)\033[0m\n";
                }
                $isWorkingDay = false;
            } else {
                echo "$day\n";
                if ($dayOfWeek == 5) { // Если пятница, следующий рабочий день будет в понедельник
                    $isWorkingDay = true;
                }
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

?>