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
  function delete_user(obj)
  {
   if(confirm("确定删除该用户?"))
    	{
    		location.href="../deal/user_delete.php?user_id="+obj;
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
    <li class="active"><a href="#">用户管理</a></li>
    <li><a href="item_alarm_mag.php">举报管理</a></li>
    <li><a href="../index.php">返回主页</a></li>
</ul>
</div><!--middle_left end-->
<div id="admin_mid_right">
<h1 class="border1">用户管理
<span style="float:right;"><a class="btn btn-primary" data-toggle="modal" href="#myModal" >+新建</a></span>
</h1>
<p>
<form action="#" method="get">
用户筛选：
<select name="status" style="width:110px;">
<option value="">---全部状态---</option>
<option value="0">正常</option>
<option value="1">禁用</option>
</select>&nbsp;&nbsp;
<select name="type" style="width:130px;">
<option value="">--全部用户类型--</option>
<option value="0">管理员</option>
<option value="1">普通用户</option>
</select>&nbsp;&nbsp;
<input type="text" name="user_id" placeholder="搜索用户名" />&nbsp;&nbsp;
<input type="submit" name="search_submit" value="搜索" />
</button>
</form>
</p>
<div><!--用户list-->
<table class="table">
<thead>
<tr>
<th>用户名</th>
<th>类型</th>
<th>警告次数</th>
<th>状态</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php
$type=$_GET['type'];
$status=$_GET['status'];
$user_id=$_GET['user_id'];
if($type=="" && $status==""){
	$sql="select * from user where user_id like '%".$user_id."%'";
}elseif($type==""){
	$sql="select * from user where status=".$status." and user_id like '%".$user_id."%'";
}elseif($status==""){
	$sql="select * from user where user_type=".$type." and user_id like '%".$user_id."%'";
}else{
	$sql="select * from user where user_type=".$type." and status=".$status." and user_id like '%".$user_id."%'";
}

$perNumber=20; //每页显示的记录数
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
<td width="25%"><?php echo $row["user_id"]; ?></td>
<td><?php 
if($row["user_type"]=='0'){
	echo "管理员";}
if($row["user_type"]=='1'){
	echo "普通用户";}
?></td>
<td><?php echo $row["alarm"];?></td>
<td><?php 
if($row["status"]=='0'){
	echo "正常";}
if($row["status"]=='1'){
	echo "禁言";}
?></td>
<td><a href="user_modify.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-info">修改</a>&nbsp;&nbsp;
<a onclick="delete_user(<?php echo $row['user_id']; ?>)" class="btn">删除</a></td>
</tr>
<?php
} //分页循环输出end?>
<tr><td colspan="5" style="text-align:center;"><!--页码显示，上面为分页内容-->
<?php
if ($page != 1) { //页数不等于1
?>
<a href="user_mag.php?page=1&type=<?php echo $type; ?>&status=<?php echo $status; ?>&user_id=<?php echo $user_id; ?>">首页</a><!--回到首页-->
<a href="user_mag.php?page=<?php echo $page - 1;?>&type=<?php echo $type; ?>&status=<?php echo $status; ?>&user_id=<?php echo $user_id; ?>">上一页</a> <!--显示上一页-->
<?php
}
?>
<?php echo $page."&nbsp;"; ?>
<?php
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
?>
<a href="user_mag.php?page=<?php echo $page + 1;?>&type=<?php echo $type; ?>&status=<?php echo $status; ?>&user_id=<?php echo $user_id; ?>">下一页</a>
<a href="user_mag.php?page=<?php echo $totalPage;?>&type=<?php echo $type; ?>&status=<?php echo $status; ?>&user_id=<?php echo $user_id; ?>">尾页</a><!--去尾页-->
</td></tr><!--此tr为页码的tr-->
<?php
  }//页码end
?>
</tbody>
</table>
</div><!--用户list end-->

<!--模态框开始-->
<div class="modal hide" id="myModal">
<div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>新建用户</h3>
    </div>
    <form action="../deal/user_add.php" method="post">
    <div class="modal-body">
    <table>
    <tr><td width="30%"><strong>用户名：</strong></td>
    <td><input type="text" name="user_id" /><span class="font_style3" style="font-size:12px;">*推荐使用学号</span></td></tr>
    <tr><td><strong>密码：</strong></td>
    <td><input type="password" name="password" /></td></tr>
    <tr><td><strong>重复密码：</strong></td>
    <td><input type="password" name="password_again" /></td></tr>
    <tr><td><strong>用户类型：</strong></td>
    <td><input type="radio" name="user_type" value="0"/>管理员
    <input type="radio" name="user_type" value="1" checked="checked"/>普通用户</td></tr>
    </table>
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" name="admin_submit" class="btn btn-primary" value="提交">
    </div>
    </form>
</div><!--模态框end-->

</div><!--admin_mid_right end-->

<div class="clear"></div>
</div>

</body>
</html>