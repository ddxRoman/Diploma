<?php

// Яндекс 30 дней бесплатно 15 июня
// $apiKey = "3932d373-648f-4daa-bbf8-4a4cdde407ef";
// $cityId = "542420";
// $apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=ru&units=metric&APPID=" . $apiKey;
// $crequest = curl_init();

// Опер Везер тут хз по датам
$apiKey = "72f259ba4f74e5a8d0cbdcebe3a564bd";
$cityId = "542420";
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=ru&units=metric&APPID=" . $apiKey;
$crequest = curl_init();

curl_setopt($crequest, CURLOPT_HEADER, 0);
curl_setopt($crequest, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($crequest, CURLOPT_URL, $apiUrl);
curl_setopt($crequest, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($crequest, CURLOPT_VERBOSE, 0);
curl_setopt($crequest, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($crequest);

curl_close($crequest);
$data = json_decode($response);
$currentTime = time();
?>

<style>
    .temperature{
        font-size: 18pt;
        font-weight: 600;
    }
    .other_parameters{
        font-size: 12pt;
    }
</style>
    <?php 
    
            $temp = $data->main->temp_max;
            $temp = (int)$temp;
            if($data->weather[0]->description=="облачно с прояснениями"){ // Облачность
                ?> <img src="file/icons/weather/partly cloudy.png" width="30px"><?
            }else{
                if($data->weather[0]->description=="гроза") {
                ?><img src="file/icons/weather/Storm.png" width="30px"><?
                
                }   else{if($data->weather[0]->description=="переменная облачность"){
                    ?> <img src="../file/icons/weather/partly cloudy.png" width="30px"><?
                }else{if($data->weather[0]->description=="ясно"){
                    ?> <img src="../file/icons/weather/Sun.png" width="30px"><?
                }else{
                    if($data->weather[0]->description=="небольшая облачность"){
                        ?> <img src="../file/icons/weather/littlBigCloud.png" width="30px"><?
                } else  if($data->weather[0]->description=="небольшой проливной дождь"){
                    ?> <img src="../file/icons/weather/small_rain.png" width="30px"><?
                }
                else if($data->weather[0]->description=="небольшой дождь"){
                    ?> <img src="../file/icons/weather/small_rain.png" width="30px"><?
                }
                else
            echo ucwords($data->weather[0]->description); 
                }
            }
        } 
    }
            ?>
        <font class="temperature"><?php echo $temp; ?>°C </font> <br><!-- Температура -->
   <font class="other_parameters"><img src="file/icons/weather/wett.png" width="20px"> <?php echo $data->main->humidity; ?> % <!-- Влажность -->
    <img src="file/icons/weather/wind.png" width="20px"><?php echo $data->wind->speed; ?> м/с<br><!-- Скорость ветра --></font>


