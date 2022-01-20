<?php

     ?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="jquery.js"></script>
    <script src="jquery-csv.js"></script>

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
                <span>WARMUP </span>
                <div class="float-end form-check form-checkmark bd-highlight ">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div> </div>

    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">

    var WorkoutCsv ;
    var uebungenCSV ;
    $(document).ready(function(){
        $.get("Workout.csv", function(data, status){WorkoutCsv = data; });
        $.get("Uebungen.csv", function(data, status){uebungenCSV = data;});

        $("button").click(function(){
            loadWorkout();
        });
    });

    function generateNew() {

    }
    function loadWorkout() {
        var csvarray= $.csv.toArrays(WorkoutCsv,{"separator" : ";"});

        $.each(csvarray, function( index, value ) {
           $.(#workoutplan).innerText = 
        });
    }

    function renderTabels() {

    }
</script>
</html>


