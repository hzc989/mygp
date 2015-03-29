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
  if(empty($_POST['content'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  $last_editor=$_SESSION["user_id"];
      $content=$_POST["content"];
	   $result=mysql_query("insert into rule (content,last_editor) values ('$content','$last_editor')"); 
          if($result==true)
            {
         	  	echo "<script>";
         		echo "alert(\"添加成功！\");";	
                 echo "history.go(-1);"; 
	         	echo "</script>";
	            }
         else {	   
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