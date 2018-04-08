<?php header("Content-Type: text/html; charset=utf-8");

$cityName = 'yekaterinburg';
$city = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$cityName&APPID=3f22f3fb80167efc601a9167886ec893");
$data = [];
$data = json_decode($city,true);

$cityName =($data['name']);
$weather_icon = ($data['weather'][0]['icon']);
$weather_type = ($data['weather'][0]['description']); 
$temperarure = ($data['main']['temp']);
$pressure = ($data['main']['pressure']); 
$humidity = ($data['main']['humidity']);
$windspeed = ($data['wind']['speed']);
$sunrise = ($data['sys']['sunrise']);
$sunset = ($data['sys']['sunset']);

$pressure = $pressure * 0.75006375541921; 
$pressure = round($pressure); 
$temperarure = round($temperarure-273.15);
	if ($temperarure>0) {
		$temperarure ='+'.$temperarure;
	}
$sunrise = date('H:i',$sunrise);
$sunset = date('H:i',$sunset);

$title = "Давление: ".$pressure." мм рт. ст.\nВетер: ".$windspeed." м/с \nВлажность: ".$humidity."% \nВосход: ".$sunrise."\nЗакат: ".$sunset;
echo "<h2>$cityName</h2><br><h3>$weather_type</h3>";
echo ("<img src='http://openweathermap.org/img/w/$weather_icon.png'alt=\"$weather_type\" title=\"$title\" >"); 
echo ("$temperarure<sup>o</sup>C<br>");
 
 ?>