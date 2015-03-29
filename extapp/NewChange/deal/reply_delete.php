<?php include ("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
include("user_check.php");
$reply_id=$_GET['reply_id'];
$result=mysql_query("SELECT * FROM reply WHERE reply_id=".$reply_id);
$row=mysql_fetch_array($result);
if($row["replier"]!=$_SESSION["user_id"]){//验证是否发帖人本人删除
	echo "<script>";
	echo "alert(\"你无权限删除此帖子！\");";	
    echo "history.go(-1);"; 
    echo "</script>";
}else{
     $replydelete_res=mysql_query("DELETE FROM reply WHERE reply_id=".$reply_id);
		   if($replydelete_res==true){
	  	         echo "<script>";
		         echo "alert(\"删除成功！\");";	
                 echo "history.go(-1);";
		         echo "</script>";
                 }else {	   
	            	echo "<script>";
	           	    echo "alert(\"删除失败！请重新操作\");";	
                    echo "history.go(-1);"; //刷新操作！！！！！！！
	            	echo "</script>";
                 }
}
 ?>
</body>
</html>