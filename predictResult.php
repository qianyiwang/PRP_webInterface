<?php
//clear the finishFlag table    
$mysql_server_name="198.71.225.61"; //数据库服务器名称
$mysql_username="qianyi"; // 连接数据库用户名
$mysql_password="123456789"; // 连接数据库密码
$mysql_database="my_db"; // 数据库的名字
// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);
mysql_select_db("my_db",$conn);
mysql_query("DELETE FROM finishFlag");
mysql_close($conn);
?>
<html>
  <head>
    <title>RoutePrediction</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBOPAlnFZMIQ3Zv3T7djHWc-OCbcKTIoC0&sensor=SET_TO_TRUE_OR_FALSE"></script>
  </head>
  <body>
    <script>
        var i = 0;
        var lat = new Array();
        var lon = new Array();

    </script>
      <?php
      
        $mysql_server_name="198.71.225.61"; //数据库服务器名称
        $mysql_username="qianyi"; // 连接数据库用户名
        $mysql_password="123456789"; // 连接数据库密码
        $mysql_database="my_db"; // 数据库的名字

        // 连接到数据库
        $conn=mysql_connect($mysql_server_name, $mysql_username,
                                        $mysql_password);
        mysql_select_db("my_db",$conn);
        $result = mysql_query("SELECT * FROM position");
        while($row = mysql_fetch_array($result)) {
        // echo $row['lat'] . " " . $row['lon'];
        $lat_temp = $row["lat"];
        $lon_temp = $row["lon"];
         //$lat[] = $row["lat"];
         //$lon[] = $row["lon"];
         
        echo "<script>
                lat[i] = $lat_temp;
                lon[i] = $lon_temp;
                i = i+1;
                
            </script>";
     }
        mysql_close($conn);
        ?>
    <script>
    function initialize() {
        if (lat.length === 0)
        {
            var mapOptions = {
            zoom: 12,
            //center: new google.maps.LatLng(lat[5],lon[5]),
            center: new google.maps.LatLng(42.25,-83.25),
            mapTypeId: google.maps.MapTypeId.TERRAIN
            };
        }
        else{
            var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(lat[5],lon[5]),
            //center: new google.maps.LatLng(42.25,-83.25),
            mapTypeId: google.maps.MapTypeId.TERRAIN
      };
        }

      var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

      /*var flightPlanCoordinates = 
        [
        new google.maps.LatLng(42.302779, -83.489842),
        new google.maps.LatLng(42.302419, -83.488801),
        new google.maps.LatLng(42.302390, -83.488141),
        new google.maps.LatLng(42.302430, -83.486921),
        new google.maps.LatLng(42.302529, -83.486931)

      ];*/

      var flightPlanCoordinates = new Array();
      for (var i = 0; i < lat.length;i++){
          flightPlanCoordinates[i]=new google.maps.LatLng(lat[i], lon[i]);
      }

      //alert(flightPlanCoordinates);
      var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });

      flightPath.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="map-canvas" style="width:100%; height: 100%"></div>
    
  </body>


