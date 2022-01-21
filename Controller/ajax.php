<?php
switch($_GET['action']) {
   case 'writeNewWorkout':
       writeNewWorkout();
       echo getWorkout();
       break;
   case 'getWorkout':
       echo getWorkout();
       break;
   default:
       return;
}

function writeNewWorkout()
{
    $uebungsArray = getUebungen();
    $workoutArray = getRandomWorkout($uebungsArray);
    $csvFile=fopen("../csv/Workout.csv","w");
    foreach ($workoutArray as  $key =>$workout){
        fputcsv($csvFile,[$key,$workout[0],$workout[1]],";"," ");
    }
    fclose($csvFile);
}

function getRandomWorkout($array){
    $workoutType =[];
    foreach ($array as $row){
        $workoutType[$row[0]][] = [$row[1],$row[2]];
    }

    $workoutArray=[];
    foreach ($workoutType as $type=>$uebung){
        $section = array_rand($uebung);
        $workoutArray[$type]=$uebung[$section];
    }
    
    return $workoutArray;
}

function getUebungen(){

    $csvFile=fopen("../csv/Uebungen.csv","r");
    $array=getLines($csvFile);
    fclose($csvFile);
    return $array;
}

function getWorkout(){
    $csvFile=fopen("../csv/Workout.csv","r");
    $array = getLines($csvFile);
    fclose($csvFile);
    ob_start();
    print_r(json_encode($array));
    error_log(ob_get_contents());
    ob_end_clean();
    return json_encode($array);
}

function getLines($csvFile){
    $arrayLines=[];
    while ($data = fgetcsv($csvFile,0,";")) {
        $arrayLines[]=$data;
    }
    return $arrayLines;
}

