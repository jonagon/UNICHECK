<?php
if (!isset($_GET['q'])) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>        
  <head>            
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">            
    <meta name="UNICHECK" content="PSPad editor, www.pspad.com">            
    <title>         
    </title>            
    <LINK rel="stylesheet" type="text/css" href="css/bootstrap.css">            
    <LINK rel="stylesheet" type="text/css" href="css/css1.css">        
  </head>        
  <body>             
    <br>         
    <br>         
    <br>         
    <br>         
    <br>         
    <br>         
    <br>         
    <br>         
    <br>            
    <div class="row" id="header">                
      <div class="col-md-2">                
      </div>                   
      <div class="col-md-4">                 
        <a href="index.php">                     
          <img src="bilder/logo.png"></a>                
      </div>                   
      <div class="col-md-4"><h1> UNICHECK </h1>                
      </div>                   
      <div class="col-md-2">                
      </div>             
    </div>         
    <br>         
    <br>         
    <br>         
    <br>                                                                        
    <div class="row">                   
      <form class="form-horizontal" role="form" method="GET" action="">               
        <div class="col-md-2 col-md-offset-1">                        
          <select id="select" name="select" class="form-control">                       
            <option value="0">Alles                              
            </option>                             
            <option value="1">Stadt                              
            </option>                             
            <option value="2">Fach                              
            </option>                             
            <option value="3">Tr&auml;ger                              
            </option>                             
            <option value="4">Art der Uni                              
            </option>                         
          </select>                     
        </div>        
        <div class="col-md-6">          
          <input type="text" name="q" class="form-control" id="inputStadt" placeholder="Suche">           
        </div>                                 
        <div class="col-md-2">                                                      
          <button type="submit" class="btn btn-default">SUCHE STARTEN  &nbsp;<img src="images/search.png">                     
          </button>                          
        </div>                           
        <br>                     
        <br>                             
      </form>                
    </div>                   
    <div class="row">             
      <div class="col-md-10 col-md-offset-1" >
      <div id="map" style="width: 80%; height: 200px;"></div>                        
        <script src="leaflet/leaflet.js"></script>
  <script src="map/map.js"></script>                 
      </div>            
    </div>  
  </body>
</html>

<?php
}else{ 
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhmtl" xml:lang= "de">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=ISO-">
  <title>UNICHECK</title>
  <LINK rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <LINK rel="stylesheet" type="text/css" href="css/css1.css">
  <LINK rel="stylesheet" type="text/css" href="leaflet/leaflet.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="Chart.min.js"></script>
  </head>
  
  <body>
<div style="background: #ddd;">
<br><br>
    <div class="row" >                   
      <form class="form-horizontal" role="form" method="GET" action="">               
        <div class="col-md-2 col-md-offset-1">                        
          <select id="select" name="select" class="form-control">                       
            <option value="0">Alles                              
            </option>                             
            <option value="1">Stadt                              
            </option>                             
            <option value="2">Fach                              
            </option>                             
            <option value="3">Tr&auml;ger                              
            </option>                             
            <option value="4">Art der Uni                              
            </option>                         
          </select>                     
        </div>        
        <div class="col-md-6">          
          <input type="text" name="q" class="form-control" id="inputStadt" placeholder="Suche" value="<?php echo $_GET['q']; ?>">           
        </div>                                 
        <div class="col-md-2">                                                          
          <button type="submit" class="btn btn-default">SUCHE STARTEN   &nbsp;<img src="images/search.png">                        
          </button>                          
        </div>                           
        <br>                     
        <br>                             
      </form>                
    </div>                   
    <br><br>
    </div>
    <br>
    
    <div class="row">
    <?php
    $url = "http://api.openweathermap.org/data/2.5/forecast?q=".$_GET['q']."&mode=json&cnt=14";
    $datei = file_get_contents($url);
    $stadtdaten = array();
    $stadtdaten = json_decode($datei, True);
    $isset = 0;
    if ($_GET['select'] == 0 || $_GET['select'] == 1) {
        if($stadtdaten['city']['population'] == 0){
        echo '<div class="col-md-1" style="height: 50px;"></div><div class="col-md-6">';
     
      }else{
    ?>
    <div style="margin-left: 10px;" class="col-md-3">
    <a href="" class="list-group-item">
      <h4 class="list-group-item-heading">
        <h4>Daten:</h4><br>
        <h4>Name: <?php echo $stadtdaten['city']['name']; ?></h4>
        <h4>Einwohner: <?php echo $stadtdaten['city']['population']; ?></h4>
        <h4>Koordinaten:</h4>
        <h4><?php echo $stadtdaten['city']['coord']['lon']; ?></h4>
        <h4><?php echo $stadtdaten['city']['coord']['lat']; ?></h4>
      <canvas id="myChart" width="300px" height="300px"></canvas>
    </a>
    
    
    <script type="text/javascript">
    $(document).ready(function(){
      var ctx = document.getElementById("myChart").getContext("2d");
    var data = {
      labels : ["Temp.","Regen","Luft","Wind"],
      datasets : [
        {
          fillColor : "rgba(220,220,220,0.5)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          data : [<?php echo $stadtdaten['list'][0]['main']['temp'].','.$stadtdaten['list'][0]['main']['humidity'].','.$stadtdaten['list'][0]['main']['pressure'].','.$stadtdaten['list'][0]['wind']['speed']; ?>]
        },
        {
          fillColor : "rgba(151,187,205,0.5)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          data : [<?php echo $stadtdaten['list'][30]['main']['temp'].','.$stadtdaten['list'][30]['main']['humidity'].','.$stadtdaten['list'][30]['main']['pressure'].','.$stadtdaten['list'][30]['wind']['speed']; ?>]
        }
      ]
    }
    new Chart(ctx).Radar(data);
    });
    
    </script>
    
    
    <br>
    
   </div>

   <div class="col-md-4">
    <?php
    }
    
  }else{
     echo '<div class="col-md-1" style="height: 50px;"></div><div class="col-md-6">';
  }

$suche = mysql_real_escape_string($_GET['q']);
  $verbindung = mysql_connect("localhost", "root", "")or die ("Fehler im System");
  mysql_select_db("unisuche")or die ("Verbindung zur Datenbank war nicht m&ouml;glich...");

if ($_GET['select'] == 0) {
  $sql = "SELECT * FROM universitaeten WHERE `UNINAME` LIKE  '%$suche%'";
}
if ($_GET['select'] == 1) {
  $sql = "SELECT * FROM universitaeten WHERE `UNINAME` LIKE  '%$suche%'";
}
if ($_GET['select'] == 2) {
  $sql = "SELECT * FROM universitaeten WHERE `UNINAME` LIKE  '%$suche%'";
}
if ($_GET['select'] == 3) {
  $sql = "SELECT * FROM universitaeten WHERE `Traeger` LIKE  '%$suche%'";
}
if ($_GET['select'] == 4) {
  $sql = "SELECT * FROM universitaeten WHERE `artderuni` LIKE  '%$suche%'";
}

$ergebnis = mysql_query($sql);
  while($row = mysql_fetch_object($ergebnis))
  {
    $seite = '';
      $breitengrad = str_replace(',', '.', $row->Breitengrad);
      $laengengrad = str_replace(',', '.', $row->Laengengrad);
      $name = $row->UNINAME;
        $sql2 = "SELECT * FROM uni_links WHERE Uni = '$name'";
        $ergebnis2 = mysql_query($sql2);
        while($row2 = mysql_fetch_object($ergebnis2))
        {
            $seite = $row2->seite;
        }
        echo '<a href="'.$seite.'" class="list-group-item"><h4 class="list-group-item-heading">'.$row->UNINAME.'</h4><br><p class="list-group-item-text"><span class="bewertung" style="float: right;">Bewertung: <img src="images/4stars.png" /></span>Fachrichtung</p></a><div style="display: none;"><div class="location">'.$breitengrad.','.$laengengrad.'</div><div class="linkname">'.$seite.'</div><div class="uniname">'.$row->UNINAME.'</div></div>';
  }

?>
    
    </div>

    <div class="col-md-4">
    <div id="map" style="height: 800px;"></div>                        
          
    
    </div> 
    
    </div>
    
    
  <script src="leaflet/leaflet.js"></script>
  <script src="map/map.js"></script>
  </body>
</html>
<?php 
}
?>