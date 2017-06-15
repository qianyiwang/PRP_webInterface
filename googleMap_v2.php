

<!DOCTYPE html>
<?php
//clear the ODposition and position table
$lat = $_GET['lat'];
 $lng = $_GET['lng'];     
$mysql_server_name="198.71.225.61"; //数据库服务器名称
$mysql_username="qianyi"; // 连接数据库用户名
$mysql_password="123456789"; // 连接数据库密码
$mysql_database="my_db"; // 数据库的名字
// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);
mysql_select_db("my_db",$conn);
mysql_query("DELETE FROM ODposition");
mysql_query("DELETE FROM position");
mysql_query("DELETE FROM position_T");
mysql_query("DELETE FROM travelTime");
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
    <!--div>
        <form action="goPosition.php" method="post">
            lat: <input type="text" name="latitude" />
            lon: <input type="text" name="longitdue" />
            <input type="submit" />
        </form>
    </div-->
     <script>
        var i = 0;
        var lat = new Array();
        var lon = new Array();
        var cont =0;
    </script>
    <button type="button" onclick="postPosition()">
        <input type="submit" name="originLocation" value=" Confirm " 
        style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
        text-align:center; font-size:20px; font-family:Century Gothic">
    </button>
    <button type="button" onclick="clearAll()">
        <input type="submit" name="originLocation" value=" ClearMarkers " 
        style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
        text-align:center; font-size:20px; font-family:Century Gothic">
    </button>
    
    Origin Latitude:<select id="oriLat">
                        <option value="42.3020">42.3020</option>
                        <option value="42.2716">42.2716</option>
                    </select>
    Origin Longitude:<select id="oriLng">
                        <option value="-83.4908 ">-83.4908 </option>
                        <option value="-83.4866">-83.4866</option>
                     </select>
    Destination Latitude: <select id="destLat">
                            <option value="42.2987">42.2987</option>
                            <option value="42.2924">42.2924</option>
                         </select>
    Destination Longitude:<select id="destLng">
                            <option value="-83.2294">-83.2294</option>
                            <option value="-83.2354">-83.2354</option>
                         </select>
    <button onclick="submitValue()">Submit Position</button>
    <script>
        function submitValue()
        {
            //var x = document.getElementById("destLat").value;
            //console.log("here"+x);
            //alert(x);
            if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
                }
              else
                {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                    xmlhttp.onreadystatechange=function()
              {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                  {
                  var temp=xmlhttp.responseText;
                  alert (temp);
                  }
                }
                xmlhttp.open("GET","setLatLngText.php?oriLat=" + document.getElementById("oriLat").value + "&oriLng=" + document.getElementById("oriLng").value + "&destLat=" + document.getElementById("destLat").value + "&destLng=" + document.getElementById("destLng").value,true);

                xmlhttp.send();
                window.location.href="prpInterface.php?process=1";//if jump, make process = 1 so interface will vist database
                    }
    </script>
   


<script>
var map;
var myCenter=new google.maps.LatLng(42.3187,-83.2345);
var position = new Array();
var markers = new Array();
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:10,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  google.maps.event.addListener(map, 'click', function(event) {
        clearMarkers();
        placeMarker(event.latLng);
    
  });
  
}

function placeMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  clearMarkers();
  markers.push(marker);
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
  recordNum(location.lat(),location.lng());
 
}
// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
  console.log('clear');
 // cont = 0;
  position = [];
}
function clearAll()
{
     setAllMap(null);
     cont = 0;
     position = [];
     //clear the database using ajax
     if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
        xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      var temp=xmlhttp.responseText;
      alert (temp);
      }
    }
    xmlhttp.open("GET","clearODposition.php" ,true);

    xmlhttp.send();
}
function recordNum(lat,lng){

    position[0] = lat;
    position[1] = lng;
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
    
    function postPosition(){
        var xmlhttp;
        cont = cont + 1;
        console.log("here"+cont);
        //ajax 
        if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
        xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      var temp=xmlhttp.responseText;
      alert (temp);
      }
    }
    xmlhttp.open("GET","setLatLng.php?lat=" + position[0] + "&lng=" + position[1],true);

    xmlhttp.send();
        //go back to interface
    if (cont === 2)
    {
        cont = 0;
        window.location.href="prpInterface.php?process=1";//if jump, make process = 1 so interface will vist database
    }
    
}


</script>
<script>

//document.getElementById("position").value = position;

</script>

      
    <div id="googleMap" style="width:100%; height: 100%"></div>
  </body>
</html>

