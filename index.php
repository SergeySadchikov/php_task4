<?php

$cityName = 'yekaterinburg';
$link = "http://api.openweathermap.org/data/2.5/weather?q=$cityName&APPID=3f22f3fb80167efc601a9167886ec893";

$city = file_get_contents($link);
if ($city === false) {
	exit('Не удалось получить данные');
}

$data = json_decode($city,true);
if ($data === NULL) {
	exit('Ошибка декодирования JSON');
}

$cityName = !empty($data['name']) ? $data['name'] : 'не удалось получить название города';
$weather_icon = !empty($data['weather'][0]['icon']) ? $data['weather'][0]['icon'] : 'изображение недоступно';
$weather_type = !empty($data['weather'][0]['description']) ? $data['weather'][0]['description'] : 'описание недоступно';
$temperarure = !empty($data['main']['temp']) ? $data['main']['temp'] : 'данные отсутствуют';
$pressure = !empty($data['main']['pressure']) ? $data['main']['pressure'] : 'данные отсутствуют';
$humidity = !empty($data['main']['humidity']) ? $data['main']['humidity'] : 'данные отсутствуют';
$windspeed = !empty($data['wind']['speed']) ? $data['wind']['speed'] : 'данные отсутствуют';
$sunrise = !empty($data['sys']['sunrise']) ? $data['sys']['sunrise'] : 'данные отсутствуют';
$sunset = !empty($data['sys']['sunset']) ? $data['sys']['sunset'] : 'данные отсутствуют';

$pressure = $pressure * 0.75006375541921; 
$pressure = round($pressure); 
$temperarure = round($temperarure-273.15);
	if ($temperarure>0) {
		$temperarure ='+'.$temperarure;
	}
$sunrise = date('H:i',$sunrise);
$sunset = date('H:i',$sunset);

$title = "Давление: ".$pressure." мм рт. ст.<br>Ветер: ".$windspeed." м/с<br>Влажность: ".$humidity."%<br>Восход: ".$sunrise."<br>Закат: ".$sunset;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Погода в Екатеринбурге</title>
	<meta charset="utf-8">
</head>
<body>
	<h2><?php echo $cityName; ?></h2>
	<h3><?php echo $weather_type; ?></h3>
	
	<div><img src="http://openweathermap.org/img/w/<?php echo $weather_icon ?>.png" title="<?php echo ($weather_type) ?>"><?php echo $temperarure; ?><sup>o</sup>C</div>
	<div><?php echo $title; ?></div>
</body>
</html>