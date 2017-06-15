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
      <button type="button" onclick="goback()">
                <input type="submit" name="originLocation" value=" Go Back to Menu " 
                style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
                text-align:center; font-size:20px; font-family:Century Gothic">
      </button>
      <p>Travel Time (minutes)
          <input type="text" id="time"></p>
      <p>Accuracy
          <input type="text" id="accuracy" value="NaN"></p>
    <script>
        var i = 0;
        var j = 0;
        var lat = new Array();
        var lon = new Array();
        var lat_T = new Array();
        var lon_T = new Array();
        var ori = new Array();
        //var dest = new Array();
        function goback()
        {
            window.location.href="prpInterface.php";
        }
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
        while($row = mysql_fetch_array($result)) 
                {
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
        
        $result = mysql_query("SELECT * FROM position_T");
        while($row = mysql_fetch_array($result))
        {
            $lat_T_temp = $row["lat_T"];
            $lon_T_temp = $row["lon_T"];
            echo "<script>
                 lat_T[j] = $lat_T_temp;
                 lon_T[j] = $lon_T_temp;
                 j = j+1;
                 </script>";
        }
     ?>
    <?php
    $mysql_server_name="198.71.225.61"; //数据库服务器名称
        $mysql_username="qianyi"; // 连接数据库用户名
        $mysql_password="123456789"; // 连接数据库密码
        $mysql_database="my_db"; // 数据库的名字

        // 连接到数据库
        $conn=mysql_connect($mysql_server_name, $mysql_username,
                                        $mysql_password);
        mysql_select_db("my_db",$conn);
        $result = mysql_query("SELECT * FROM ODposition");
        $row = mysql_fetch_array($result);
        $oriLat = $row["Lat"];
        $oriLng = $row["Lng"];
        
        
        /*$row = mysql_fetch_array($result);
        $destLat = $row['lat'];
        $destLng = $row['lng'];
        mysql_close($conn);*/
        echo "<script>
                ori[0] = $oriLat;
                ori[1] = $oriLng; 
                
            </script>";
        ?>
    <?php
    $mysql_server_name="198.71.225.61"; //数据库服务器名称
        $mysql_username="qianyi"; // 连接数据库用户名
        $mysql_password="123456789"; // 连接数据库密码
        $mysql_database="my_db"; // 数据库的名字
        // 连接到数据库
        $conn=mysql_connect($mysql_server_name, $mysql_username,
                                        $mysql_password);
        mysql_select_db("my_db",$conn);
        $result = mysql_query("SELECT * FROM travelTime");
        $row = mysql_fetch_array($result);
        $t = $row['time'];
        $result2 = mysql_query("SELECT * FROM accuracy");
        $row2 = mysql_fetch_array($result2);
        $acc = $row2['accuracy'];
        echo "<script>
                var travelTime = $t;
                var accuracy = $acc;
            </script>";
        ?>
    <script>

    function initialize() 
    { 
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
            center: new google.maps.LatLng(lat[10],lon[10]),
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
        strokeOpacity: 0.6,
        strokeWeight: 7
      });
      var flightPlanCoordinates_T = new Array();
      for (var i = 0; i < lat_T.length;i++){
          flightPlanCoordinates_T[i]=new google.maps.LatLng(lat_T[i], lon_T[i]);
      }

      //alert(flightPlanCoordinates);
      var flightPath_T = new google.maps.Polyline({
        path: flightPlanCoordinates_T,
        geodesic: true,
        strokeColor: '#000080',
        strokeOpacity: 0.6,
        strokeWeight: 7
      });
      flightPath.setMap(map);
      flightPath_T.setMap(map);
 
      
      var cirPosition = new google.maps.LatLng(ori[0],ori[1]);
        var myCity = new google.maps.Circle({
        center:cirPosition,
        radius:240,
        strokeColor:"#0000FF",
        strokeOpacity:0.8,
        strokeWeight:2,
        fillColor:"#0000FF",
        fillOpacity:0.4
        });

      myCity.setMap(map);
      var trafficLayer = new google.maps.TrafficLayer();
      trafficLayer.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    document.getElementById("time").value = travelTime;
    document.getElementById("accuracy").value = accuracy;
    </script>
    <div id="map-canvas" style="width:100%; height: 100%"></div>
    
  </body>


