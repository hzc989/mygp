<?php include ("../deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type = "text/javascript" language = "javascript">
  function delete_attach(obj)
  {
   if(confirm("确定删除该附件?确认后附件将被立即删除。"))
    	{
    		location.href="../deal/attach_delete.php?item_id="+obj;
    	}else{
    		return false;
    	}
  }
</script>
<title>无标题文档</title>
</head>

<body>
<?php
include("header.php");
?>
<div id="middle">
<?php
$item_id=$_GET['item_id'];
$result=mysql_query("SELECT * FROM item WHERE item_id=".$item_id);
$row=mysql_fetch_array($result);
if($row["author"]!=$_SESSION["user_id"]){
	echo "<script>";
	echo "alert(\"你无权限删除此帖子！\");";	
    echo "history.go(-1);"; 
    echo "</script>";
}else{//验证是否发帖人本人修改
    $item_res=mysql_query("SELECT * FROM item WHERE item_id=".$item_id);
	$item_list=mysql_fetch_array($item_res);//遍历结果集,取一个值
?>
<!--test 框-->
    <div class="dialog_style1">
    <h1>帖子修改</h1>
    <div class="alert alert-info">
    <table>
    <form method="post" enctype="multipart/form-data" action="../deal/item_modify_deal.php">
    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
    <tr>
    <td>种类:</td>
    <td>
    <select name="type" id="type">
    <?php 
	$type_res=mysql_query("select * from type");
    while ($type_list=mysql_fetch_array($type_res)) { 
	    if($type_list["type"]==$item_list["type"]){
			echo "<option value=\"".$type_list['type']."\" selected=\"selected\">".$type_list['name']."</option>"; 
		 }else{ 
            echo "<option value=\"".$type_list['type']."\">".$type_list['name']."</option>"; 
         } //if..else..的结束符号
	}
    ?>
    </select>
    </td>
    </tr>
    <tr>
    <td>标题:</td>
    <td><input type="text" name="title" style="width:400px;" value="<?php echo $item_list['title']; ?>" /></td>
    </tr>
    <tr>
    <td>内容:</td>
    <td><textarea rows="5" name="content" style="width:400px;"><?php echo $item_list['content']; ?></textarea></td>
    </tr>
    <tr>
    <td>附件:</td>
    <td>
    <?php
	if($item_list["attachment"]!=null){?>
    <a href="<?php echo $item_list['attachment']; ?>"><?php echo basename($item_list["attachment"]); ?></a>&nbsp;&nbsp;
    <a onclick="delete_attach(<?php echo $item_id; ?>)" style="font-weight:bold;">删除</a>
    <span class="font_style3" style="font-size:12px;">*附件重传必须先删除原附件</span>
    <?php }else{ ?>
    <input type="file" name="file" id="file" /><span class="font_style3" style="font-size:12px;">*附件名称不能包含中文</span>
    <?php } ?>
    </td>
    </tr>
    <tr><td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary" value="确定修改"/>   
    <a class="btn" href="item_detail.php?item_id=<?php echo $item_id; ?>">返回</a></td></tr>
    </form>
    </table>
    </div>
    <?php } ?>
    </div><!--中间部分end-->
</div>
<?php include("footer.php"); ?>
</body>
</html>