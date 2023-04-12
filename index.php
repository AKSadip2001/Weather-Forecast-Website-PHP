<?php
function fetchData($city, $lat, $lon){
    $url = "https://api.openweathermap.org/data/2.5/forecast?q=$city&units=metric&lat=$lat&lon=$lon&appid=a8f5b7a2ba6be49558787806a1f2302d";
    $contents = file_get_contents($url);
    return json_decode($contents);
}

$cityName="dhaka";

if(isset($_POST["search"])){
    if($_POST["city"]!=""){
        $cityName = $_POST["city"];
    }
}

$climate = fetchData($cityName, "", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wheather</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="row main">
            <div class="col d-flex flex-column p-4 left">
                <nav class="navbar navbar-light justify-content-between">
                    <h5>forecast</h5>
                    <div class="location">
                        <h6>Current Location:</h6>
                        <h6>
                            <?php
                            echo ucwords($cityName);
                            ?>
                        </h6>
                    </div>
                </nav>
                <div class="search align-self-center">
                    <h1>The only forcast you need</h1>
                    <form method="POST" action="index.php" class="input-group mb-3">
                        <input type="text" name="city" class="form-control" placeholder="Enter City" aria-describedby="basic-addon2">
                        <input class="btn btn-secondary" type="submit" name="search"  value="Search">
                    </form>
                </div>
            </div>
            <div class="col px-5 py-4">
                <h1 class="day">
                    <?php
                    echo ucwords($cityName);
                    ?>'s Weather Today
                </h1>
                <div class="row d-flex align-items-center p-3 today">
                    <div class="col-6 d-flex flex-column justify-content-center today-left">
                        <h1>
                            <?php
                            echo $climate->list[0]->main->temp . " °C";
                            ?>
                        </h1>
                        <h3>
                            <?php
                            echo $climate->list[0]->weather[0]->main;
                            ?>
                        </h3>
                        <h6>
                            <?php
                            date_default_timezone_set('Asia/Dhaka');
                            echo date("l jS\, F Y") ;
                            ?>
                        </h6>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end today-right">
                        <h6>Wind: 
                            <?php
                            echo $climate->list[0]->wind->speed . " km/hr";
                            ?></h6>
                        <h6>Humidity: 
                            <?php
                            echo $climate->list[0]->main->humidity . "%";
                            ?></h6>
                        <h6>Pressure: 
                            <?php
                            echo $climate->list[0]->main->pressure;
                            ?></h6>
                        <h6>Real feel: 
                            <?php
                            echo $climate->list[0]->main->feels_like . " °C";
                            ?></h6>
                        <h6>Max temp: 
                            <?php
                            echo $climate->list[0]->main->temp_max . " °C";
                            ?></h6>
                        <h6>Min temp: 
                            <?php
                            echo $climate->list[0]->main->temp_min . " °C";
                            ?></h6>
                    </div>
                </div>

                <h1 class="day">Upcoming Days</h1>
                <div class="daily p-3">
                    <div class="row">
                        <div class="col-3">
                            <h6>Day</h6>
                        </div>
                        <div class="col-3">
                            <h6>Temperature</h6>
                        </div>
                        <div class="col-3">
                            <h6>Whether</h6>
                        </div>
                        <div class="col-3">
                            <h6>Humidity</h6>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-3">
                            <h6>
                                <?php
                                echo date('D jS\, F', strtotime($climate->list[7]->dt_txt),);
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[7]->main->temp . " °C";
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[7]->weather[0]->icon . '@2x.png" height="30px" alt="weather-icon">';
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[7]->main->humidity . "%";
                                ?>
                            </h6>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-3">
                            <h6>
                                <?php
                                echo date('D jS\, F', strtotime($climate->list[15]->dt_txt),);
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[15]->main->temp . " °C";
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[15]->weather[0]->icon . '@2x.png" height="30px" alt="weather-icon">';
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[15]->main->humidity . "%";
                                ?>
                            </h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h6>
                                <?php
                                echo date('D jS\, F', strtotime($climate->list[23]->dt_txt),);
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[23]->main->temp . " °C";
                                ?>
                            </h6>
                        </div>                        
                        <div class="col-3">
                            <h6>
                                <?php
                                echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[23]->weather[0]->icon . '@2x.png" height="30px" alt="weather-icon">';
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[23]->main->humidity . "%";
                                ?>
                            </h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h6>
                                <?php
                                echo date('D jS\, F', strtotime($climate->list[31]->dt_txt),);
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[31]->main->temp . " °C";
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[31]->weather[0]->icon . '@2x.png" height="30px" alt="weather-icon">';
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[31]->main->humidity . "%";
                                ?>
                            </h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h6>
                                <?php
                                echo date('D jS\, F', strtotime($climate->list[39]->dt_txt),);
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[39]->main->temp . " °C";
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[39]->weather[0]->icon . '@2x.png" height="30px" alt="weather-icon">';
                                ?>
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6>
                                <?php
                                echo $climate->list[39]->main->humidity . "%";
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </div>
    
</body>
</html>