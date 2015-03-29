<?php include ("../deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
if(isset($_POST['admin_submit'])){
	if(empty($_POST['user_id'])|| empty($_POST['password'])|| empty($_POST['user_type'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	$stu=mysql_query("select * from user where  user_id='$_POST[user_id]'");
    $row=mysql_fetch_array($stu);
    if($row){
        echo "<script>";
		echo "alert(\"该账号已注册！\");";	
        echo "history.go(-1);";
		echo "</script>";
    }
	if($_POST['password']!=$_POST['password_again']){
	  	echo "<script>";
		echo "alert(\"两次输入密码不一致，请重新注册！\");";	
        echo "history.go(-1);";
		echo "</script>";
    }else{
		$user_id=$_POST["user_id"];
		$password=$_POST["password"];
		$user_type=$_POST["user_type"];
		$alarm=0;
		$status='0';
		$result=mysql_query("insert into user (user_id,password,user_type,alarm,status) values
            ('$user_id','$password','$user_type','$alarm','$status')"); 
        if($result==true){
	  		echo "<script>";
			echo "alert(\"添加成功！\");";	
 	        echo "location.href=\"../others/user_mag.php\";";
			echo "</script>";
        }else {	   
	 	 	echo "<script>";
			echo "alert(\"添加失败！请重新添加\");";	
 	        echo "history.go(-1);";
    		echo "</script>";

	}
	}
  }
}
?>
</body>
</html>