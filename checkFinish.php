
<?php
$mysql_server_name="198.71.225.61"; //数据库服务器名称
$mysql_username="qianyi"; // 连接数据库用户名
$mysql_password="123456789"; // 连接数据库密码
$mysql_database="my_db"; // 数据库的名字

// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);
mysql_select_db("my_db",$conn);
$result = mysql_query("SELECT * FROM finishFlag");
while($row = mysql_fetch_array($result))
{
    $temp = $row['finishFlag'];
    if ($temp == '1')
        {
            echo "1";
        }
    else
        {
            echo "2";
        }
}



mysql_close($conn);
?>

