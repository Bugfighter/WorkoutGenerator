<?php
session_start();
switch($_GET['action']) {
    case 'getFileAge':
        echo getFileAge();
        break;
   case 'writeNewWorkout':
       writeNewWorkout();
       echo getWorkout();
       break;
   case 'getWorkout':
       echo getWorkout();
       break;
   case 'getUebungen':
       echo json_encode(getUebungen());
       break;
   case 'writeUebungen':
       echo writeUebungen($_POST["csvstring"]);
       break;
   default:
       return;
}

function writeNewWorkout()
{
    $uebungsArray = getUebungen();
    $workoutArray = getRandomWorkout($uebungsArray);
//    $csvFile = fopen("../csv/Workout.csv","w");
//    foreach ($workoutArray as  $key =>$workout){
//        fputcsv($csvFile,[$key,$workout[0],$workout[1]],";"," ");
//    }
//    fclose($csvFile);
    $_SESSION["workout"]["uebungen"]=[];
    $_SESSION["workout"]["date"] = date ("d.m.Y H:i:s.");
    foreach ($workoutArray as  $key =>$workout){
        $_SESSION["workout"]["uebungen"][] = $key.";".$workout[0].";".$workout[1];
    }
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

function writeUebungen($string){

    $csvFile=fopen("../csv/Uebungen.csv","w+");
    $success=fwrite($csvFile,$string);
    fclose($csvFile);
    if($success === false){
        $success = "Daten nicht gespeichert error beim fwrite";
    }else{
        $success = "Daten erfolgreich Gespeichert";
    }
    return $success;
}

function getFileAge(){
   return date ("d.m.Y H:i:s.", filemtime("../csv/Workout.csv"));
}

function getWorkout(){
    if( !isset($_SESSION["workout"])){
        return false;
    }        $array=[];
            foreach ($_SESSION["workout"]["uebungen"] as $row){
                $array[] = str_getcsv($row,";");
            }

    return json_encode($array);
}

function getLines($csvFile){
    $arrayLines=[];
    while ($data = fgetcsv($csvFile,0,";")) {
        $arrayLines[]=$data;
    }
    return $arrayLines;
}

