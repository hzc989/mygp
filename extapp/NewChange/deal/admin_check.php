<?php include ("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
<?php
$result=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user_id']." and status=0");
$row=mysql_fetch_array($result);
if($row['user_type']!="0"){
	echo "<script>";
	echo "alert(\"你没有权限访问此页\");";	
    echo "history.go(-1);";//返回上一页
	echo "</script>";
    exit();
}
?>
</body>
</html>