<?php include ("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
if(isset($_POST['submit'])){
  if(empty($_POST['content'])|| empty($_POST['title'])|| empty($_POST['type'])){
	  	echo "<script>";
		echo "alert(\"内容填写不完整，请重新填写！\");";	
        echo "history.go(-1);"; 
		echo "</script>";
  }else{
	  //先定义字段
	  $author=$_SESSION["user_id"];
      $content=$_POST["content"];
      $title=$_POST["title"];
      $type=$_POST["type"];
      date_default_timezone_set('PRC');//时间调正操作！！！！！！
      $time=date('Y-m-d H:i:s');
	  //定义字段结束
	   if(empty($_FILES["file"]["name"])){//验证是否有上传文件
	   //这个是无file的情况
	//要是没有上传文件时数据库的操作
	      $result=mysql_query("insert into item (type,title,content,attachment,author,time,last_modify,status) values
            ('$type','$title','$content',Null,'$author','$time','$time','0')"); 
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
		
	}else{//如果验证了没有上传的文件，则下面的就不需要了。
	  //下面是有file的情况
      if ($_FILES["file"]["error"] > 0){
      echo "Error: " . $_FILES["file"]["error"] . "<br />";//①（1）这是有file的情况且有错误的情况
     }else{
/*      echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      echo "Type: " . $_FILES["file"]["type"] . "<br />";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
     echo "Stored in: " . $_FILES["file"]["tmp_name"];}
*/
    if(!is_dir("../upload/".$_SESSION['user_id']."/")){     // is_dir()函数判断指定的文件夹是否存在
      mkdir("../upload/".$_SESSION['user_id']."/");       // mkdir()函数创建文件夹
      }//admin可以替换为用户的ID，则可建立用户个人的文件夹
    if (file_exists("../upload/".$_SESSION['user_id']."/". $_FILES["file"]["name"])){
		  echo "<script>";
          echo "alert('".$_FILES["file"]["name"]."已存在，请重新上传');";	
          echo "history.go(-1);"; 
	      echo "</script>";
      }else{
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../upload/".$_SESSION['user_id']."/".$_FILES["file"]["name"]);//保存在本地
	  //数据库其他操作
	      $attachment="../upload/".$_SESSION['user_id']."/".$_FILES["file"]["name"];
	      $attach_result=mysql_query("insert into item (type,title,content,attachment,author,time,last_modify,status) values
            ('$type','$title','$content','$attachment','$author','$time','$time','0')"); 
          if($attach_result==true)
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
        
      } //请注意编码问题，此处上传的文件名不能包含中文
	}//①（2）这是有file的情况且无错误的情况
	 
	 }
	  
	  } 
}
?>
</body>
</html>