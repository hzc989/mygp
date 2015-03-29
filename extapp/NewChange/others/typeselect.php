<?php include ("../deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
include("header.php");
$type_id=$_GET['type'];
?>
<div id="middle">
<?php include("middle_left.php"); ?>
<div id="middle_right">
<h1 class="border1">
<?php
$typename_res=mysql_query("select * from type where type=".$type_id);//执行sql语句，得到一个结果集
$typename_list=mysql_fetch_array($typename_res);//遍历结果集,取一个值
echo $typename_list["name"];
?>
</h1>
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
$count=mysql_query("select count(*) from item where status='0' and type=".$type_id); //获得记录总数
$rs=mysql_fetch_array($count); 
$totalNumber=$rs[0];
$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
if (!isset($page)) {
 $page=1;
} //如果没有值,则赋值1
$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
$result=mysql_query("select * from item where status='0' and type=".$type_id." order by last_modify desc limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数
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