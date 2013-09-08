<?php
if (!isset($_GET['q'])) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <title></title>
  <LINK rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="topbar"></div>
    <div id="sidebar"></div>
    <div id="map">
      <script src="leaflet/leaflet.js"></script>  
      <script src="map/map.js"></script>
    </div>
    <div id="content">
    <form action="" method="get">
      <select id="select" name="select"><option value="0">Alles</option><option value="1">Stadt</option><option value="2">Fach</option><option value="3">Tr&auml;ger</option><option value="4">Art der Uni</option></select>
      <input type="text" name="q">
      <input type="submit" value="Suchen!"> 
    </form>
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
  <LINK rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>
    <br><br>
    <div class="col-md-4">
    </div>
    
    <h1>Suche '<?php echo $_GET['q']; ?>'</h1>
    
    
    <div class="row">
    <div class="col-md-3">
    
    <h4>wetter ...</h4>
    <img scr="#" width="200px" height="200px">
    <br>
    <img scr="#" width="200px" height="200px">
    <br>
    <img scr="#" width="200px" height="200px">
    <br>
    <img scr="#" width="200px" height="200px">
    <br>
   </div>
   <div class="col-md-4">
<?php
    $suche = mysql_real_escape_string($_GET['q']);
	$verbindung = mysql_connect("localhost", "root", "")or die ("Fehler im System");
    mysql_select_db("unisuche")or die ("Verbindung zur Datenbank war nicht m&ouml;glich...");
	$sql = "SELECT * FROM universitaeten WHERE `UNINAME` LIKE  '%$suche%'";
	$ergebnis = mysql_query($sql);
    while($row = mysql_fetch_object($ergebnis))
    {
    echo '<a href="" class="list-group-item"><h4 class="list-group-item-heading">'.$row->UNINAME.'</h4><br><p class="list-group-item-text">Fachrichtungen: </p></a>';
    }

?>
    
    </div>

    <div class="col-md-4">
   
    <h4>KARTE</h4>
    <br><br>
    <div id="map"></div>
	  
    </div> 
    
    </div>
    
    
  <script src="leaflet/leaflet.js"></script>	
	<script src="map/map.js"></script>
  </body>
</html>
<?php 
}
?>