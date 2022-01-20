<?php
switch($_GET['action']) {
   case 'writeNewWorkout':
       writeNewWorkout();
       break;
   case 'getWorkout':
       getWorkout();
       break;
   default:
       return;
}

function writeNewWorkout()
{
    $uebungsArray = getUebungen();
    $workoutArray = getRandomWorkout($uebungsArray);
    $csvString = "";
    foreach ($workoutArray as $type => $workout){
      $csvString.= "{$type};".$workout['UEBUNG'].";".$workout['DESC']."\n";
    }
    file_put_contents("../csv/Workout.csv",$csvString);
}

function getRandomWorkout($array){
    $workoutArray=[];
    foreach ($array as $type=>$uebung){
        $section = array_rand($uebung);

        $workoutArray[$type]=$uebung[$section];
    }
    return $workoutArray;
}

function getUebungen(){
    $stringCsv = file_get_contents("../csv/Uebungen.csv");
    $lines = explode(PHP_EOL, $stringCsv);
    $uebungsArray = [];
    getLines();
    foreach ($lines as $line) {
        $arrayLine = str_getcsv($line);
        $uebungsArray[$arrayLine[0]][]= ["UEBUNG" => $arrayLine[1], "DESC" => $arrayLine[2]];
    }
    return $uebungsArray;
}

function getWorkout(){
    $stringCsv = file_get_contents("../csv/Workout.csv");
    $lines = explode(PHP_EOL, $stringCsv);
    $array = getLines($lines);
    echo json_encode($array);;
}
function getLines(){
    $arrayLine=[];
    foreach ($lines as $line) {
        $arrayLine[] = str_getcsv($line);
    }

    return $arrayLine;
}

