<?php
echo "We are calculating the route for you, please wait patiently!!";
$Flag = $_GET['flag'];
$mysql_server_name="198.71.225.61"; //数据库服务器名称
$mysql_username="qianyi"; // 连接数据库用户名
$mysql_password="123456789"; // 连接数据库密码
$mysql_database="my_db"; // 数据库的名字
// 连接到数据库
$conn=mysql_connect($mysql_server_name, $mysql_username,
                                $mysql_password);
mysql_select_db("my_db",$conn);
$sql = mysql_query("INSERT INTO flag (flag) VALUES ('$Flag')");
mysql_close($conn);
?>
<html>
    <body>
        <input type="text" id="txt">
    </body>

<script>
    //ajax timing
    var c = 0;
    var t;
    t=setTimeout("setAjax()",1000);
    
    function setAjax()
    {
        console.log("ajax");
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
                    console.log(temp);
                    if (temp==1)
                        {
                            console.log('here');
                            clearTimeout(t);
                            window.location.href="prpInterface.php";
                        }
                    else
                      
                    document.getElementById("txt").value=c
                    c=c+1
                            
                    }
                }
            xmlhttp.open("GET","checkFinish.php?",true);
           
            xmlhttp.send();
            t=setTimeout("setAjax()",1000);
    }
</script>
</html>
    
