<?php

     ?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-csv.js"></script>
    <style>
        .btn-primary {
            background-color:#ff6600;
            border-color: #ff6600;        }
        .btn-primary:hover {
            background-color:#ff6600;
            border-color:#ff6600;
        }
        .btn-primary:focus {
            background-color: #ff6600;
            border-color: #ff6600;
            box-shadow: 0 0 0 0.25rem #ff660050;
        }
        .btn-primary:active:focus {
            box-shadow: 0 0 0 0.25rem #ff660050;
        }

    </style>
<!--    <script-->
<!--        src="https://code.jquery.com/jquery-3.6.0.js"-->
<!--        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="-->
<!--        crossorigin="anonymous"></script>-->
    <title>Workout Generator</title>

</head>
<body>
    <div class="d-flex p-2 d-flex flex-column justify-content-center align-items-center ">
        <button  type="button" class="btn btn-primary btn-lg" style="width: 100%"> Generate Workout</button>
            <div id="workoutplan">
<!--                <span>WARMUP </span>-->
<!--                <div class="float-end form-check form-checkmark bd-highlight ">-->
<!--                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">-->
<!--                </div> -->

            </div>

    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">

    var WorkoutCsv ;
    var uebungenCSV ;
    $(document).ready(function(){
        fillCsvArray();

        $("button").click(function(){
            generateNew();
            fillCsvArray()
        });

    });

    function fillCsvArray() {
        $.get("csv/Workout.csv", function(data, status){WorkoutCsv = data;loadWorkout(); });
        $.get("csv/Uebungen.csv", function(data, status){uebungenCSV = data; });
    }

    function generateNew() {
        $.get("Controller/ajax.php?action=writeNewWorkout");
    }

    function loadWorkout() {
        $.getJSON("Controller/ajax.php?action=getWorkout",function (data) {
            var div = $("#workoutplan");
            div.html("");
            var oldhtml=div.html();
            $("#workoutplan").html(oldhtml+"<div>"+data+"</div>");
        });
        // $("#workoutplan").html(oldhtml+"<div>:"+ValueArray[1]+"</div>");
        //
        // var div = $("#workoutplan");
        // div.html("");
        // var csvarray = $.csv.toArrays(WorkoutCsv,{"seperator" : ";"});
        //
        // $.each(csvarray, function( index, value ) {
        //     var string = ""+value;
        //     var ValueArray = string.match(/(;+)\.(;+)/);;
        //     var oldhtml=div.html();
        //     $("#workoutplan").html(oldhtml+"<div>:"+ValueArray[1]+"</div>");
        // });
    }

    function renderTabels() {

    }
</script>
</html>


