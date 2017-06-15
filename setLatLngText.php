<?php
$oriLat = $_GET['oriLat'];
$oriLng = $_GET['oriLng'];
$destLat = $_GET['destLat'];
$destLng = $_GET['destLng'];
 
//echo $p;      
$mysql_server_name="198.71.225.61"; //数据库服务器名称
$mysql_username="qianyi"; // 连接数据库用户名
$mysql_password="123456789"; // 连接数据库密码
$mysql_database="my_db"; // 数据库的名字

// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);
mysql_select_db("my_db",$conn);
$sql = mysql_query("INSERT INTO ODposition (Lat,Lng) VALUES ('$oriLat','$oriLng')");
$sql = mysql_query("INSERT INTO ODposition (Lat,Lng) VALUES ('$destLat','$destLng')");
mysql_close($conn);
//$sql = mysql_query("INSERT INTO ODposition (Destination) VALUES ('$lng')");
//echo $p;
echo "Position Has Been Selected!!"
        
?>

