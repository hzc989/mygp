<?php include ("../deal/admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/bootstrap/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
<link href="../style/style.css" type="text/css" rel="stylesheet" />
<script src="../style/bootstrap/js/bootstrap.min.js"></script>
<script src="../style/bootstrap/js/jquery.min.js"></script>
<script src="../style/bootstrap/js/bootstrap-tab&modal.js"></script>
<script type = "text/javascript" language = "javascript">
  function delete_alarm(obj)
  {
   if(confirm("确定删除该举报?"))
    	{
    		location.href="../deal/alarm_delete.php?reply_alarm_id="+obj;
    	}else{
    		return false;
    	}
  }
</script>
<title>无标题文档</title>
</head>

<body>
<div id="middle">
<div id="admin_mid_left">
<ul class="nav nav-pills nav-stacked">
    <li><a href="notice_mag.php">公告管理</a></li>
    <li><a href="user_mag.php">用户管理</a></li>
    <li class="active"><a href="#">举报管理</a></li>
    <li><a href="../index.php">返回主页</a></li>
</ul>
</div><!--middle_left end-->
<div id="admin_mid_right">
    <ul class="nav nav-tabs">
    <li><a href="item_alarm_mag.php">帖子举报</a></li>
    <li class="active"><a href="#">回复举报</a></li>
    </ul>
   <h1 class="border1">回复举报
</h1>
<p>
<form action="#" method="get">
举报筛选：
<select name="status" style="width:110px;">
<option value="">---全部状态---</option>
<option value="0">未通过</option>
<option value="1">已通过</option>
</select>&nbsp;&nbsp;
<input type="text" name="owner" placeholder="搜索回复所属人" />&nbsp;&nbsp;
<input type="submit" name="search_submit" value="搜索" />
</button>
</form>
</p>
<div><!--用户list-->
<table class="table">
<thead>
<tr>
<th>原帖标题</th>
<th>状态</th>
<th>回复所属</th>
<th>违规详情</th>
<th>审查操作</th>
</tr>
</thead>
<tbody>
<?php
$status=$_GET['status'];
$owner=$_GET['owner'];
if($status!=""){
	$sql="select * from reply_alarm where status=".$status." and owner like '%".$owner."%'";
}else{
	$sql="select * from reply_alarm where owner like '%".$owner."%'";
}
$perNumber=10; //每页显示的记录数
$page=$_GET['page']; //获得当前的页面值
$count=mysql_query($sql); //获得记录总数
$totalNumber=mysql_num_rows($count);
$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
if (!isset($page)) {
 $page=1;
} //如果没有值,则赋值1
$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
$result=mysql_query($sql." limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数
while ($row=mysql_fetch_array($result)) {
?>
<tr>
<td width="45%"><!--输出item_title-->
<a href="item_detail.php?item_id=<?php echo $row["item_id"]; ?>">
<?php 
$item_res=mysql_query("select * from item where item_id=".$row["item_id"]);//执行sql语句，得到一个结果集
$item_list=mysql_fetch_array($item_res);//遍历结果集,取一个值
echo $item_list["title"];
?></a>
</td>
<td><!--输出状态-->
<?php
if($row["status"]=='0'){
	echo "未通过";
}else{
	echo "已通过";
}
?>
</td>
<td><!--输出回复所属-->
<?php echo $row["owner"]; ?>
</td>
<td><!--输出违规详情-->
<a class="btn" data-toggle="modal" href="#ReplyModal<?php  echo $row['id']; ?>">查看</a>
<div class="modal hide" id="ReplyModal<?php  echo $row['id']; ?>">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>违规详情</h3>
    </div>
    <div class="modal-body">
    <p><strong>回复内容：</strong>
    <?php 
	$reply_res=mysql_query("select * from reply where reply_id=".$row["reply_id"]);//执行sql语句，得到一个结果集
    $reply_list=mysql_fetch_array($reply_res);//遍历结果集,取一个值
    echo $reply_list["content"];
	?>
    </p>
    <p><strong>违规原因：</strong>
	<?php 
	$reason_res=mysql_query("select * from reply_alarm where id=".$row["id"]);//执行sql语句，得到一个结果集
    $reason_list=mysql_fetch_array($reason_res);//遍历结果集,取一个值
    echo $reason_list["reason"];
	?></p>
    </div>
    </div>
<!--模态框结束-->
</td>
<td><!--审查操作(below)-->
<a href="reply_alarm_modify.php?id=<?php echo $row['id']; ?>" class="btn btn-info">审查</a><!--新建一页进行修改-->&nbsp;&nbsp;
<?php
if($row["status"]=='0'){
?>
<a onclick="delete_alarm(<?php echo $row['id'];?>)" class="btn">删除</a>
<?php } //只有未通过的情况才有删除按钮 ?>
</td>
</tr>
<?php } //分页输出内容end
?>
<tr><td colspan="5" style="text-align:center;"><!--页码显示，上面为分页内容-->
<?php
if ($page != 1) { //页数不等于1
?>
<a href="reply_alarm_mag.php?page=1&status=<?php echo $status; ?>&owner=<?php echo $owner; ?>">首页</a><!--回到首页-->
<a href="reply_alarm_mag.php?page=<?php echo $page - 1;?>&status=<?php echo $status; ?>&owner=<?php echo $owner; ?>">上一页</a> <!--显示上一页-->
<?php
}
?>
<?php echo $page."&nbsp;"; ?>
<?php
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
?>
<a href="reply_alarm_mag.php?page=<?php echo $page + 1;?>&status=<?php echo $status; ?>&owner=<?php echo $owner; ?>">下一页</a>
<a href="reply_alarm_mag.php?page=<?php echo $totalPage;?>&status=<?php echo $status; ?>&owner=<?php echo $owner; ?>">尾页</a><!--去尾页-->
</td></tr><!--此tr为页码的tr-->
<?php
  }//页码end
?>
</tbody>
</table> 
    
</div><!--admin_mid_right end-->


<div class="clear"></div>
</div>

</body>
</html>