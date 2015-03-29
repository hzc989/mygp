<?php include ("../deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../style/bootstrap/js/jquery.min.js"></script>
<script src="../style/bootstrap/js/bootstrap-tab&modal.js"></script>
<title>无标题文档</title>
</head>

<body>
<?php 
include("../deal/user_check.php");
include("header.php");
?>
<div id="middle">
<?php include("middle_left.php"); ?>

<div id="middle_right">
<h1 class="border1">我的帖子
<span style="float:right;"><a class="btn" data-toggle="modal" href="#myModal" >+新建</a></span>
</h1>
<!--模态框开始-->
<div class="modal hide" id="myModal">
<div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>新建帖子</h3>
    </div>
    <form action="../deal/item_add.php" method="post" enctype="multipart/form-data">
    <div class="modal-body">
    <table>
    <tr>
    <td><span class="font_style3">*</span>种类：</td>
    <td>
    <select name="type" id="type">
    <?php
	$type_rs=mysql_query("select * from type"); //根据前面的计算出开始的记录和记录数
    while ($type_row=mysql_fetch_array($type_rs)) {
		echo "<option value=".$type_row["type"].">".$type_row["name"];
	}
	 ?>
    </select>
    </td>
    </tr>
    <tr>
    <td><span class="font_style3">*</span>标题：</td>
    <td><input type="text" name="title"  style="width:400px;"/></td>
    </tr>
    <tr>
    <td><span class="font_style3">*</span>内容：</td>
    <td><textarea rows="5" name="content" style="width:400px;"></textarea></td>
    </tr>
    <tr>
    <td>附件：</td>
    <td>
    <input type="file" name="file" id="file" /><span class="font_style3" style="font-size:12px;">*文件名不能包含中文</span>
    </td></tr>
    </table>
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" name="submit" class="btn btn-primary" value="提交">
    </div>
    </form>
</div><!--模态框end-->

<table class="table">
<thead>
<tr>
<th width="13%">种类</th>
<th width="34%">标题</th>
<th width="18%">发帖ID</th>
<th width="9%">回复数</th>
<th width="26%">最后回复</th>
</tr>
</thead>
<tbody>    
<?php
$perNumber=20; //每页显示的记录数
$page=$_GET['page']; //获得当前的页面值
$count=mysql_query("select count(*) from item where status='0' and author=".$_SESSION['user_id']); //获得记录总数
$rs=mysql_fetch_array($count); 
$totalNumber=$rs[0];
$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
if (!isset($page)) {
 $page=1;
} //如果没有值,则赋值1
$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
$result=mysql_query("select * from item where status='0' and author=".$_SESSION['user_id']." order by last_modify desc limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数
while ($row=mysql_fetch_array($result)) {
$type=$row["type"];
$item_id=$row["item_id"];
?>
<tr class="font_style1">
<td>
<?php
$res=mysql_query("select * from type where type=".$type);//执行sql语句，得到一个结果集
$list=mysql_fetch_array($res);//遍历结果集,取一个值
echo $list["name"];
?>
</td>
<td><a href="item_detail.php?item_id=<?php echo $item_id; ?>"><?php echo $row["title"]; ?></a></td>
<td><?php echo $row["author"]; ?></td>
<td>
<?php 
$reply_count=mysql_query("select * from reply where status='0' and item_id=".$item_id);
echo mysql_num_rows($reply_count);//***显示总共有多少个回复
?></td>
<td><?php echo $row["last_modify"]; ?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" style="text-align:center; color:#000;">
<?php
if ($page != 1) { //页数不等于1
?>
<a href="myitem.php?page=<?php echo $page - 1;?>">上一页</a> <!--显示上一页-->
<?php
}
?>
<?php echo $page; ?>
<?php
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
?>
<a href="myitem.php?page=<?php echo $page + 1;?>">下一页</a>
<?php
} 
?>
</td>
</tr>
</tbody>
</table>
</div><!--middle_right end-->

<div class="clear"></div>
</div>
<?php include("footer.php"); ?>

</body>
</html>