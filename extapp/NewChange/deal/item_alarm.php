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
if(isset($_POST['item_alarm'])){
  if(empty($_POST['reason'])||empty($_POST['item_id'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  $item_id=$_POST["item_id"];
      $reason=$_POST["reason"];
	  $owner=$_POST["owner"];

	  $item_alarm=mysql_query("select * from item_alarm where item_id='$_POST[item_id]'");
      $row=mysql_fetch_array($item_alarm);
      if($row){
        echo "<script>";
		echo "alert(\"此贴已被举报，请静候审查！\");";	
        echo "history.go(-1);"; //刷新操作！！！！！！！
		echo "</script>";
      }else{
	    $result=mysql_query("insert into item_alarm(item_id,owner,reason,status) values ('$item_id','$owner','$reason','0')"); 
	    if($result==true){
		  echo "<script>";
          echo "alert(\"举报成功！\");";	
          echo "history.go(-1);"; 
	      echo "</script>";
	    }else{
		  echo "<script>";
          echo "alert(\"举报失败！请重新举报\");";	
          echo "history.go(-1);";
          echo "</script>"; 
	    }
	  }
	  
  }
}
?>
</body>
</html>