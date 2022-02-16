<html>
<?php include "header.php"; ?>
<body>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <h1>Workout Generator</h1>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <div id="fileAge"></div>
    </div>
    <div class="d-flex flex-wrap p-3 flex-column justify-content-start">
        <table id="workoutplan" >

        </table>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <button id="generate" type="button" class="btn btn-primary btn-lg" style="width: 100%"> Generate Workout</button>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <button  type="button" class="btn btn-secondary btn-lg" style="width: 100%" onclick="darkmode()"> DarkMode</button>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <button id="copy-to-clipboard-button" type="button" class="btn btn-secondary btn-lg" style="width: 100%" > Copy to clipboard</button>
        <textarea  style="opacity: .01;height:0;position:absolute;z-index: -1; " id="toClipboard"></textarea>
    </div>
    <div class="d-flex p-2 flex-column justify-content-center align-items-center ">
        <a class="btn btn-secondary btn-lg" style="width: 100%" href="edit.php" > EDIT</a>
    </div>
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
        var DATEWorkout = "";
        $.get("Controller/ajax.php?action=getFileAge",function (data) {
            if(data !== ""){
                $("#fileAge").html("Das Workout wurde am "+data+" erstellt");
                DATEWorkout = data;
                console.log(data);
            }
        });

            $.getJSON("Controller/ajax.php?action=getWorkout",function (data) {
            console.log(data);
            var div = $("#workoutplan");
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
                    + "<td>" + value[0]+": </td> "
                    + "<td><button data-toggle='collapse' data-target='#descCollapse"+ descCounter +"' class='btn btn-secondary'>" + value[1]+"</button></td>"
                    + "<tr class='collapse' id='descCollapse"+ descCounter +"'> <td colspan='2'> <p>"+value[2]+"</P> </td></tr>"
                    + "</tr>";
                div.html(oldhtml);
            });
                var clipboard = $("#toClipboard");
                var clipboardText ="";
                skipFirst = true;
                $.each(data, function( index, value ) {
                    if(skipFirst){
                        skipFirst=false;
                        clipboardText = clipboardText +DATEWorkout+"\n";
                        return;
                    }
                       clipboardText = clipboardText +"*"+value[1]+"*" +"("+value[2]+")\n";

            });
                clipboard.html(clipboardText);
            });
    }

    function darkmode() {
        var element = document.body;
        element.classList.toggle("dark-mode");

        var element = $(".btn-primary");
        element.classList.toggle("dark-mode");
    }

    jQuery(document).ready(function($) {
        $('#copy-to-clipboard-button').on('click', function(e) {
            e.preventDefault();

            $('#toClipboard').select();
            document.execCommand('copy');
        });
    });

</script>
</html>


