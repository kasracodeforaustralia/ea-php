<?php 

function getAllCarShows($energyAustraliaAPI){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $energyAustraliaAPI);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $carShows = curl_exec($ch);

    if($carShows === FALSE){
        // return "CURL Error: " . curl_errno($ch);
        return ($carShows = "server issue");
    }

    curl_close($ch);

    return $carShows;
}
function listAllCars($carShows){
    $allCars = [];
    $carShowArr = json_decode($carShows, true);
    foreach($carShowArr as $show){
        foreach($show['cars'] as $car){
            $carDetails = ['make' =>$car['make'], 'model' => $car['model'], 'show' =>$show['name'] ];
            array_push($allCars, $carDetails);
        }
    }
    return json_encode($allCars);
}
function compareByName($a, $b) {
    return strcmp($a['make'], $b['make']);
}
  
function sortCarsByMake($allCars){
    $allCarsArr = json_decode($allCars, true);
    usort($allCarsArr, 'compareByName');
    return json_encode($allCarsArr);
}
?>