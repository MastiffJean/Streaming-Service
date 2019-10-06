<?php
  if ($count == 0) {
    echo 'Ничего не найдено :(';
  } elseif (($count - $count % 10) % 100 != 10) {
    if ($count % 10 == 1) {
      echo 'Найден '.$count.' пользователь';
    } elseif ($count % 10 >= 2 && $count % 10 <= 4) {
      echo 'Найдено '.$count.' пользователя';
    } else {
      echo 'Найдено '.$count.' пользователей';
    } 
  } else {
    echo 'Найдено '.$count.' пользователей';
  } 
?>