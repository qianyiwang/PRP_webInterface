<?php
    $myFlag = $_GET['flag'];
    $mysql_server_name="198.71.225.61"; //数据库服务器名称
            $mysql_username="qianyi"; // 连接数据库用户名
            $mysql_password="123456789"; // 连接数据库密码
            $mysql_database="my_db"; // 数据库的名字

// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);

mysql_select_db("my_db",$conn);

$sql = mysql_query("INSERT INTO flag (flag) VALUES ('$myFlag')");
//$label = 1; 

    echo "Route Calculating!";

    while (TRUE) {
        $result = mysql_query("SELECT * FROM flag where flag = 2");
        if ($row = mysql_fetch_array($result)) {
            header('Location: goPosition.php');
            //echo "<script> window.location.href=\"goPosition.php\";</script>";
        } 
    }
?>



