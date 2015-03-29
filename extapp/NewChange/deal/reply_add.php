<?php include ("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php include("user_check.php"); ?>
<?php
if(isset($_POST['reply_add'])){
  if(empty($_POST['content'])||empty($_POST['item_id'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  $item_id=$_POST["item_id"];
	  $replier=$_SESSION["user_id"];
      $content=$_POST["content"];
      date_default_timezone_set('PRC');//时间调正操作！！！！！！
      $time=date('Y-m-d H:i:s');
	  
	  $res1=mysql_query("insert into reply (item_id,replier,content,time,status) values
            ('$item_id','$replier','$content','$time','0')"); 
	  $res2=mysql_query("update item set last_modify='$time' where item_id='$item_id'");
	  if($res1==true && $res2==true){
		  echo "<script>";
          echo "alert(\"添加成功！\");";	
          echo "history.go(-1);"; 
	      echo "</script>";
	  }else{
		  echo "<script>";
          echo "alert(\"添加失败！请重新添加\");";	
          echo "history.go(-1);";
          echo "</script>";
	  }
  }
}
?>
</body>
</html>