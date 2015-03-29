<?php include ("admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$user_id=$_GET['user_id'];
$noticedelete_res=mysql_query("DELETE FROM user WHERE user_id=".$user_id);
		   if($noticedelete_res==true){
	  	         echo "<script>";
		         echo "alert(\"删除成功！\");";	
                 echo "history.go(-1);";
		         echo "</script>";
                 }else {	   
	            	echo "<script>";
	           	    echo "alert(\"删除失败！请重新操作\");";	
                    echo "history.go(-1);"; //返回上一页操作
	            	echo "</script>";
                 }
?>
</body>
</html>