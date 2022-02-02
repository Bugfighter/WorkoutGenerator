<?php

     ?>
<html>
<head>
    <title>Workout Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-csv.js"></script>
    <style>
        .btn-check:active+.btn-outline-primary,
        .btn-check:checked+.btn-outline-primary,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show,

        .dark-mode{
            color: rgb(209, 205, 199);
            background-color: rgb(24, 26, 27);
            -webkit-tap-highlight-color: transparent;
        }
        .btn-darkmode{
            background-color: rgb(204, 82, 0);
            border-color: rgb(179, 71, 0);
        }
        .btn-outline-primary:active {
            color: #fff;
            background-color: #ff6600;
            border-color: #ff6600;
        }
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
        .nodeco{
        padding: 0;
        border: none;
        background: none;
        }
    </style>
<!--    <script-->
<!--        src="https://code.jquery.com/jquery-3.6.0.js"-->
<!--        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="-->
<!--        crossorigin="anonymous"></script>-->


</head>
<body>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <button id="generate" type="button" class="btn btn-primary btn-lg" style="width: 100%"> Generate Workout</button>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <div id="fileAge"></div>
    </div>
    <div class="d-flex flex-wrap p-3 flex-column justify-content-start">
        <table id="workoutplan" >

        </table>

    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
    <button  type="button" class="btn btn-primary btn-lg" style="width: 100%" onclick="darkmode()"> DarkMode</button>
    </div>
            <textarea hidden id="toClipboard"></textarea>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">

    var WorkoutCsv ;
    var uebungenCSV ;
    $(document).ready(function(){
        loadWorkout();
        $("#generate").click(function(){
            generateNew();
        });

    });
    function generateNew() {
        $.get("Controller/ajax.php?action=writeNewWorkout",function () {
            loadWorkout();
        });
    }

    function loadWorkout() {
        $.get("Controller/ajax.php?action=getFileAge",function (data) {
            $("#fileAge").html("Das Workout wurde am "+data+" erstellt");
            console.log(data);
        });

            $.getJSON("Controller/ajax.php?action=getWorkout",function (data) {
            console.log(data);
            var div = $("#workoutplan");
            var clipboard = $("#toClipboard");
            div.html("<table>");
            var descCounter = 0;
            var oldhtml ="";
            var skipFirst = true;
            $.each(data, function( index, value ) {
                if(skipFirst){
                    skipFirst=false;
                    return;

                }
                descCounter++;
                oldhtml = div.html();
                oldhtml = oldhtml + "<tr>"
                    + "<td><h2>" + value[0]+": </h2></td> "
                    + "<td><button data-toggle='collapse' data-target='#descCollapse"+ descCounter +"' class='btn btn-primary'><h2> " + value[1]+"</h2></button></td>"
                    + "<tr class='collapse' id='descCollapse"+ descCounter +"'> <td colspan='2'> <p>"+value[2]+"</P> </td></tr>"
                    + "</tr>";
                div.html(oldhtml);
            });
        });
    }

    function darkmode() {
        var element = document.body;
        element.classList.toggle("dark-mode");

        var element = $(".btn-primary");
        element.classList.toggle("dark-mode");
    }
</script>
</html>

