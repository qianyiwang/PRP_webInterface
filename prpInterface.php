<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<script>var process = 0;</script>
<?php
if ($_GET['process']==1)//if process = 1 visit database
{
    $mysql_server_name="198.71.225.61"; //数据库服务器名称
    $mysql_username="qianyi"; // 连接数据库用户名
    $mysql_password="123456789"; // 连接数据库密码
    $mysql_database="my_db"; // 数据库的名字
    // 连接到数据库
    $conn=mysql_connect($mysql_server_name, $mysql_username,
                                    $mysql_password);
    mysql_select_db("my_db",$conn);
    $result = mysql_query("SELECT * FROM ODposition");
    mysql_close($conn);
    //$lat_temp = $row["Lat"];
    //$lng_temp = $row["Lng"];
    $row = mysql_fetch_array($result);
    echo "
        <script>
        var Origin = new Array();
        Origin[0] = $row[0];
        Origin[1] = $row[1];
        </script>";
    
    $row = mysql_fetch_array($result);
    echo "
        <script>
        var Destination = new Array();
        Destination[0] = $row[0];
        Destination[1] = $row[1];
        </script>";
}
else
{
    echo "
        <script>
        var Destination = new Array();
        var Origin = new Array();
        Origin[0] = 0;
        Origin[1] = 0;
        Destination[0] = 0;
        Destination[1] = 0;
        </script>";
}
    
     
    


?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ford Route Prediction</title>
        <link rel="stylesheet" type="text/css" href="indexcss.css">
    </head>
    <body>
        <center>
            <button type="button" onclick="map()">
                <input type="submit" name="originLocation" value=" Choose Start/End Location " 
                style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
                text-align:center; font-size:20px; font-family:Century Gothic">
            </button>
            
        </center><br>
        <center>
        <button type="button" onclick="getFlag()">
            <input type="submit" name="originLocation" value=" RunPrediction " 
            style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
            text-align:center; font-size:20px; font-family:Century Gothic">
        </button>

    </center><br>
        <script>
            function map(){
                //alert('mapFunction')
                window.location.href="googleMap_v2.php";
            }
            
            function getFlag()
            {
                window.location.href="setFlag.php?flag=1";
            }
        </script>
        <center>
            <table frame="box">
                <tr>
                    <td><p style="font-weight:normal; font-size: 20px"> Origin: </p></td>
                    <td><p style="font-weight:normal; font-size: 20px; color:green">&nbsp;
                            <script>
                                if (Origin[1] == 0)
                                {
                                    document.writeln("Click Button to Set!");
                                }
                                else
                                {
                                    document.writeln(Origin);
                                }
                            
                            
                            </script>
                    
                        
                        
                        </p></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td><p style="font-weight:normal; font-size: 20px"> Destination: </p></td>
                    <td><p style="font-weight:normal; font-size: 20px; color:green">&nbsp;
                            <script>
                                if (Destination[1] == 0)
                                {
                                    document.writeln("Click Button to Set!");
                                }
                                else
                                {
                                    document.writeln(Destination);
                                }
                            
                            
                            </script>
                        </p></td>
                </tr>
            </table>
        </center><br>
        <center>
            <button type="button" onclick="goPredict()">
                    <input type="submit" name="originLocation" value=" SeePredictionResult " 
                    style="height:40px; width:300px; background-color:rgb(1,39,76); color:rgb(255,203,5);
                    text-align:center; font-size:20px; font-family:Century Gothic">
            </button>
        </center>
        <script>
            function goPredict()
            {
                window.location.href="predictResult_v2.php";
            }

        </script>
        
        <?php
        // put your code here
        ?>
    </body>
   
</html>
