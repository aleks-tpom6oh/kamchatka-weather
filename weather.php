<?php
    $fineName = "PK-weather.txt";
    $webPath = "http://api.openweathermap.org/data/2.5/weather?q=Petropavlovsk-Kamchatsky&units=metric&appid=d1023d268e9e55dd15d7ec661387c8f8";
    $cacheDuration = 60 * 60;

    $hasCashedData = file_exists($fineName);
    if (!$hasCashedData || (time() - filemtime($fineName) > $cacheDuration)) {
      $weatherInfo = file_get_contents($webPath);
      file_put_contents($fineName, $weatherInfo);
    } else {
      $weatherInfo = file_get_contents($fineName);
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
<!DOCTYPE>
<html lang="ru">
  <head>
      <title>Погода на Камчатке</title>
      <meta charset="utf-8">
  </head>
  <body>
    <h1>Погода в Петропавловске-Камчатском</h1>

    <h3>Сейчас: <i class="owf owf-<?php echo $decodedWeatherIconId.$suffix;?>"></i>(<?php echo $decodedWeatherData ?>)</h3>

    <h3>Температура: <?php echo $decodedTemperature ?> &deg;С</h3>

    <link href="OpenWeatherMapFont/css/owfont-regular.css" rel="stylesheet" type="text/css">
  </body>
</html>
