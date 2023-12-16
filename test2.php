<?php

/**
 * @charset UTF-8
 *
 * Задание 2. Работа с массивами и строками.
 *
 * Есть список временных интервалов (интервалы записаны в формате чч:мм-чч:мм).
 *
 * Необходимо написать две функции:
 *
 *
 * Первая функция должна проверять временной интервал на валидность
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
 * 	возвращать boolean
 *
 *
 * Вторая функция должна проверять "наложение интервалов" при попытке добавить новый интервал в список существующих
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм). Учесть переход времени на следующий день
 *  возвращать boolean
 *
 *  "наложение интервалов" - это когда в промежутке между началом и окончанием одного интервала,
 *   встречается начало, окончание или то и другое одновременно, другого интервала
 *
 *
 *
 *  пример:
 *
 *  есть интервалы
 *  	"10:00-14:00"
 *  	"16:00-20:00"
 *
 *  пытаемся добавить еще один интервал
 *  	"09:00-11:00" => произошло наложение
 *  	"11:00-13:00" => произошло наложение
 *  	"14:00-16:00" => наложения нет
 *  	"14:00-17:00" => произошло наложение
 */

# Можно использовать список:

$list = array (
	'09:00-11:00',
	'11:00-13:00',
	'15:00-16:00',
	'17:00-20:00',
	'20:30-21:30',
	'21:30-22:30',
	'23:50-01:25',
);

#$interval = "08:00-08:45";
#$times = splitInterval($interval);

#$a = validateInterval($interval);
#echo($a);
#$t = overlap($interval);
#if($t == true) {
#	echo("Наложение");
#}
#else echo("КАЙФ");


function validateInterval($interval) {
	$pattern = '/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'; // шаблон для проверки формата
	if (!preg_match($pattern, $interval)) { // если формат не соответствует шаблону
	  return false; // возвращаем false
	}
	$times = explode('-', $interval); // разделяем интервал на два времени
	$start = explode(':', $times[0]); // разделяем первое время на часы и минуты
	$end = explode(':', $times[1]); // разделяем второе время на часы и минуты
	// проверяем, что часы и минуты находятся в допустимых пределах
	if ($start[0] < 0 || $start[0] > 23 || $start[1] < 0 || $start[1] > 59 ||
		$end[0] < 0 || $end[0] > 23 || $end[1] < 0 || $end[1] > 59) {
	  return false; // если не находятся, возвращаем false
	}
	return true; // если все проверки прошли успешно, возвращаем true
  }
  

function splitInterval($interval) {
	global $list;

	$times = explode('-', $interval); // разделяем интервал на два времени
	$start = explode(':', $times[0]); // разделяем первое время на часы и минуты
	$end = explode(':', $times[1]); // разделяем второе время на часы и минуты
	return [
	  'start' => [
		'hours' => (int) $start[0],
		'minutes' => (int) $start[1]
	  ],
	  'end' => [
		'hours' => (int) $end[0],
		'minutes' => (int) $end[1]
	  ]
	];

  }
  
function overlap($interval) {
	global $list;
	$nextday1=0;
	$nextday2= 0;
	$times = splitInterval($interval);
	if($times['start']['hours'] > $times['end']['hours']){
		$nextday1 = 1;
	}
	$startTime= $times['start']['minutes'] + ($times['start']['hours']*60);
	$endTime = $times['end']['minutes'] + ($times['end']['hours']*60);

	foreach ($list as $T) {
		$time = splitInterval($T);
		$listStartTime= $time['start']['minutes'] + ($time['start']['hours']*60);
		$listEndTime= $time['end']['minutes'] + ($time['end']['hours']*60);
		
		if($listStartTime > $listEndTime){
			$nextday2 = 1;
		}

		if($nextday1 == 1 && $nextday2 == 1){
			return true;
		}

		if($endTime >= $listStartTime && $startTime <= $listEndTime){
			return true;
		}

		if($endTime >= $listStartTime && $startTime >= $listEndTime && $nextday1 == 1){
			return true;
		}

		if($startTime == $listEndTime || $endTime == $listStartTime){
			return true;
		}

	}
	return false;
}

#10:30-11:30 
   #   11:20 - 14:30

	