
<html>
<?php include "header.php"; ?>
<body>
<div class="d-flex p-2 flex-column justify-content-center ">
    <h1>Workout Generator</h1>

<textarea style="" id="csvTextArea" class="form-control"  style="width: 100%">


</textarea>
    <div class="d-flex p-2 flex-row justify-content-between  align-items-center ">
        <button class="  btn btn-primary" id="sendButton">SAVE </button>
        <a class="  btn btn-primary "href="index.php" > Back to Generator</a>
    </div>

</div><script>
    var uebungen ="";
    var uebungenNew ="";
    var textarea = $("#csvTextArea");
    $(document).ready(function(){

    });

    $("#sendButton").click(function(){
        sendToFIle();
    });
    setTimeout(setheight, 500);
     function setheight(){
         textarea.focus();
     }

    $.getJSON("Controller/ajax.php?action=getUebungen",function (data) {
      console.log(data);
        textarea.html("<table>");

      $.each(data, function( index, value ) {
          uebungen = uebungen +value[0]+";"+value[1]+";"+value[2]+";\n";
      });
        textarea.html(uebungen);
     });

    
    textarea.on("focus", function() {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });


    function sendToFIle() {
      uebungenNew = textarea.val();
      var result =$.post( "Controller/ajax.php?action=writeUebungen", { csvstring: uebungenNew },function (data) {
          alert(data);
      });
    }
</script>
</body>