<?php include ("deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<!--Expecially for HoorayOS Login NewChange-->
<?php
if(isset($_SESSION['member']['name'])){
$user_list=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['member']['name']." and status=0");
$user_res=mysql_fetch_array($user_list);
if($user_res){
	$_SESSION['user_id']=$_SESSION['member']['name'];
	echo '<script language="javascript">location.href="index.php"</script>' ;
}else{
		$user_id=$_SESSION['member']['name'];
		$password=$_SESSION["password"];
		$user_type='1';
		$alarm=0;
		$status='0';
		$result=mysql_query("insert into user (user_id,password,user_type,alarm,status) values
            ('$user_id','$password','$user_type','$alarm','$status')"); 
        if($result==true){
			$_SESSION['user_id']=$_SESSION['member']['name'];
	  		echo "<script>";
 	        echo "location.href=\"index.php\";";
			echo "</script>";
        }else {	   
			echo "<p><strong>初始化账号失败，直接进入NewChange首页</strong>&nbsp;&nbsp;";
    		echo "<a href='index.php'>进入首页</a></p>";

	    }
	
	}
}
?>
</body>
</html>