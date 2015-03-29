<?php include ("admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
if(isset($_POST['submit'])){
	  $user_id=$_POST["user_id"];
	  $user_type=$_POST["user_type"];
	  $alarm=$_POST["alarm"];
	  $status=$_POST["status"];
	  if(empty($_POST['password'])){
		  $result=mysql_query("update user set user_type='$user_type', alarm='$alarm', status='$status' where user_id=$user_id");
		  if($result==true)
            {
         	  	echo "<script>";
         		echo "alert(\"更改成功！\");";	
                echo "location.href=\"../others/user_mag.php\";";
	         	echo "</script>";
	            }
         else {	   
         	  	echo "<script>";
         		echo "alert(\"更新失败！请重新更新\");";	
                 echo "history.go(-1);";
         		echo "</script>";
        	}
	  }else{
		  $password=$_POST["password"];
		  $result=mysql_query("update user set password='$password', user_type='$user_type', alarm='$alarm', status='$status' where user_id=$user_id");
		  if($result==true)
            {
         	  	echo "<script>";
         		echo "alert(\"更改成功！\");";	
                echo "location.href=\"../others/user_mag.php\";";
	         	echo "</script>";
	            }
         else {	   
         	  	echo "<script>";
         		echo "alert(\"更新失败！请重新更新\");";	
                 echo "history.go(-1);";
         		echo "</script>";
        	}
	  }
  
}
?>
</body>
</html>