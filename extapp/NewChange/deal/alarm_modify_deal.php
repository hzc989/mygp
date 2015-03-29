<?php include ("admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
if(isset($_POST['item_alarm'])){//处理item_alarm的情况
  if(empty($_POST['reason'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  $id=$_POST["id"];
	  $status=$_POST["status"];
	  $reason=$_POST["reason"];
	  $item_alarm_res=mysql_query("select * from item_alarm where id=".$id);
      $item_alarm=mysql_fetch_array($item_alarm_res);

	  $owner=$item_alarm["owner"];
	  $item_id=$item_alarm["item_id"];
	  $status_bfore=$item_alarm["status"];
	  $user_res=mysql_query("select * from user where user_id=".$owner);
	  $user_list=mysql_fetch_array($user_res);
	  $alarm=$user_list["alarm"];
	  
	  if($status_bfore=='0' && $status=='1'){
		   $alarm=$alarm+1;  
	  }
	  if($status_bfore=='1' && $status=='0'){
		   $alarm=$alarm-1;
	  }
	  if($alarm>=3){ 
	      $user_status='1';
	  }else{
	      $user_status='0';}
		$result=mysql_query("update user, item, item_alarm set user.alarm='$alarm', user.status='$user_status', item.status='$status', item_alarm.status='$status', item_alarm.reason='$reason' where user.user_id=$owner and item.item_id=$item_id and item_alarm.id=$id");
	  //同时更新过个不相关的表
	  if($result==true)
            {
         	  	echo "<script>";
         		echo "alert(\"审查成功！\");";	
                echo "location.href=\"../others/item_alarm_mag.php\";";
	         	echo "</script>";
	            }
         else {	   
         	  	echo "<script>";
         		echo "alert(\"审查失败！请重新操作\");";	
                 echo "history.go(-1);";
         		echo "</script>";
        	}
   }
}//处理item_alarm的情况 end


if(isset($_POST['reply_alarm'])){//处理item_alarm的情况
  if(empty($_POST['reason'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  //reply_alarm情况处理
	  $id=$_POST["id"];
	  $status=$_POST["status"];
	  $reason=$_POST["reason"];
	  $reply_alarm_res=mysql_query("select * from reply_alarm where id=".$id);
      $reply_alarm=mysql_fetch_array($reply_alarm_res);

	  $owner=$reply_alarm["owner"];
	  $reply_id=$reply_alarm["reply_id"];
	  $status_bfore=$reply_alarm["status"];
	  $user_res=mysql_query("select * from user where user_id=".$owner);
	  $user_list=mysql_fetch_array($user_res);
	  $alarm=$user_list["alarm"];
	  
	  if($status_bfore=='0' && $status=='1'){
		   $alarm=$alarm+1;  
	  }
	  if($status_bfore=='1' && $status=='0'){
		   $alarm=$alarm-1;
	  }
	  if($alarm>=3){ 
	      $user_status='1';
	  }else{
	      $user_status='0';}
		$result=mysql_query("update user, reply, reply_alarm set user.alarm='$alarm', user.status='$user_status', reply.status='$status', reply_alarm.status='$status', reply_alarm.reason='$reason' where user.user_id=$owner and reply.reply_id=$reply_id and reply_alarm.id=$id");
	  //同时更新过个不相关的表
	  if($result==true)
            {
         	  	echo "<script>";
         		echo "alert(\"审查成功！\");";	
                echo "location.href=\"../others/reply_alarm_mag.php\";";
	         	echo "</script>";
	            }
         else {	   
         	  	echo "<script>";
         		echo "alert(\"审查失败！请重新操作\");";	
                 echo "history.go(-1);";
         		echo "</script>";
        	}
	  //reply_alarm处理end
  }
}
?>
</body>
</html>