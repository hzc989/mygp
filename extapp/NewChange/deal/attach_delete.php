<?php include ("db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$item_id=$_GET['item_id'];
$result=mysql_query("SELECT * FROM item WHERE item_id=".$item_id);
$row=mysql_fetch_array($result);
if($row["author"]!=$_SESSION["user_id"]){
	echo "<script>";
	echo "alert(\"你无权限删除此附件！\");";	
    echo "history.go(-1);"; 
    echo "</script>";
}else{//验证是否发帖人本人删除
$attach=$row["attachment"];
$delete_res=unlink($attach);
	if($delete_res){
		mysql_query("update item set attachment=Null where item_id=".$item_id);
		echo "<script>";
	    echo "alert(\"删除成功！\");";
		echo "history.go(-1);";
	    echo "</script>";
		}
}
?>
</body>
</html>