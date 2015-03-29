<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
<?php
if(!isset($_SESSION['user_id'])){
	echo "<script>";
	echo "alert(\"未登录不能访问此页\");";	
    echo "history.go(-1);";//返回上一页
	echo "</script>";
    exit();
}
?>
</body>
</html>