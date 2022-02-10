
<html>
<head>
    <title>Workout Generator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />
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
    </style>
</head>
<body>
<div class="d-flex p-2 flex-column justify-content-center align-items-center ">
    <h1>Workout Generator</h1>
</div>
<textarea id="csvTextArea" style="width: 100%">


</textarea>
<button onclick="sendToFIle()">SEND </button>
<script>
    var uebungen ="";
    var uebungenNew ="";
  $.getJSON("Controller/ajax.php?action=getUebungen",function (data) {
      console.log(data);
      var div = $("#csvTextArea");
      div.html("<table>");

      $.each(data, function( index, value ) {
          uebungen = uebungen +value[0]+";"+value[1]+";"+value[2]+";\n";
      });
      div.html(uebungen);
  });

  function sendToFIle() {
      var textarea = $("#csvTextArea").html;
      uebungenNew  = textarea.html();
      $.post( "Controller/ajax.php?action=writeUebungen", { csvstring: uebungenNew } );
  }
</script>
</body>