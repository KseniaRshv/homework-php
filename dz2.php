<?php
echo "Введите первое число:\n";

do {
  $a = trim(is_numeric(STDIN));
  if (ctype_digit($a) === false) {  
  fwrite(STDERR, "Введите, пожалуйста, число\n");
  } 
} while (ctype_digit($a) === false);

echo "Введите второе число:\n";

do {
  $b = trim(is_numeric(STDIN));
  
  if ((int)$b === 0) {
    fwrite(STDERR, "Делить на 0 нельзя\n");
    $b = trim(is_numeric(STDIN));
  }
  if (ctype_digit($b) === false) {  
  fwrite(STDERR, "Введите, пожалуйста, число\n");
  } 
}
  while ((int)$b === 0 || ctype_digit($b) === false);

fwrite(STDOUT, "Результат вычисления: " . $a/$b);