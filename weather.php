<?php
    $weatherInfo = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=Petropavlovsk-Kamchatsky&units=metric&appid=d1023d268e9e55dd15d7ec661387c8f8");
    
    if ($weatherInfo) {
      file_put_contents("PK-weather.txt", $weatherInfo);
    } else {
      $weatherInfo = file_get_contents("PK-weather.txt");
    }

    $decodedWeather = json_decode($weatherInfo, true);

    $decodedWeatherIconId = $decodedWeather["weather"][0]["id"];
    $decodedWeatherData = $decodedWeather["weather"][0]["main"];
    $decodedTemperature = $decodedWeather["main"]["temp"];

    $now = date('U');
  
    if($now > $decodedWeather['sys']['sunrise'] and $now < $decodedWeather['sys']['sunset']){
	     $suffix = '-d';
    } else {
	     $suffix = '-n';
    }
?>

<link href="OpenWeatherMapFont/css/owfont-regular.css" rel="stylesheet" type="text/css">

<h1>Погода в Петропавловске-Камчатском</h1>

<h3>Сейчас: <i class="owf owf-<?php echo $decodedWeatherIconId.$suffix;?>"></i>(<?php echo $decodedWeatherData ?>)</h3>

<h3>Температура: <?php echo $decodedTemperature ?> &deg;С</h3>


