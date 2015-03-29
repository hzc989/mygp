<?php include ("admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$item_alarm_id=$_GET['item_alarm_id'];
$reply_alarm_id=$_GET['reply_alarm_id'];
if($item_alarm_id!=""){
	//删除item的alarm
	       $item_alarm_res=mysql_query("DELETE FROM item_alarm WHERE id=".$item_alarm_id);
		   if($item_alarm_res==true){
	  	         echo "<script>";
		         echo "alert(\"操作成功！\");";	
                 echo "history.go(-1);";
		         echo "</script>";
                 }else {	   
	            	echo "<script>";
	           	    echo "alert(\"操作失败！请重新操作\");";	
                    echo "history.go(-1);"; //返回上一页操作
	            	echo "</script>";
                 }
	}
if($reply_alarm_id!=""){
	//删除reply的alarm
	       $reply_alarm_res=mysql_query("DELETE FROM reply_alarm WHERE id=".$reply_alarm_id);
		   if($reply_alarm_res==true){
	  	         echo "<script>";
		         echo "alert(\"操作成功！\");";	
                 echo "history.go(-1);";
		         echo "</script>";
                 }else {	   
	            	echo "<script>";
	           	    echo "alert(\"操作失败！请重新操作\");";	
                    echo "history.go(-1);"; //返回上一页操作
	            	echo "</script>";
                 }
	}

?>
</body>
</html>