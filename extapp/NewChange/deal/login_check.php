<?php include("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php

if(isset($_POST['login'])){
$result=mysql_query("SELECT * FROM user WHERE user_id='$_POST[user_id]' and status=0");
$row=mysql_fetch_array($result);
if(!$row)
{       echo "<script>";
		echo "alert(\"用户名错误或该用户已被禁言，请联系管理员！\");";	
        echo "history.go(-1);";//返回上一页
		echo "</script>";
        exit();
}
if($row['password'] == $_POST['password']){
	$_SESSION['user_id']=$_POST['user_id'];
	echo "<script>history.go(-1);</script>";
}else{
	echo "<script>";
	echo "alert(\"密码错误\");";	
    echo "history.go(-1);";
    echo "</script>";
}

}
mysql_close();
?>
</body>
</html>