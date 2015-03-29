<?php include ("deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/bootstrap/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script src="style/bootstrap/js/bootstrap.min.js"></script>
<title>首页</title>
</head>

<body>

<div id="header">
<div id="search_tab">
    <form class="form-search" action="others/itemsearch.php" method="get">
    <input type="text" placeholder="搜索帖子标题" name="title">
    <button type="submit" class="btn btn-info" name="search">搜索</button>
    </form>
</div>
<div class="clear"></div>
</div><!--header end-->

<div id="middle">
<div id="middle_left">
<?php
if(isset($_SESSION['user_id'])){
?>
<h3>个人中心</h3>
<ul class="nav nav-tabs nav-stacked">
<li>
<a href="others/myitem.php">我的帖子</a>
</li>
<li>
<?php 
$alarm_rs=mysql_query("select * from user where user_id=".$_SESSION['user_id']);//执行sql语句，得到一个结果集
$alarm_row=mysql_fetch_array($alarm_rs)//遍历结果集,取一个值
?>
<a href="others/myalarm.php">违规记录(<?php echo $alarm_row["alarm"]; ?>)</a>
</li>
<li>
<a href="deal/log off.php">退出登录</a>
</li>
</ul>
<h3>帖子汇总</h3>
<ul class="nav nav-tabs nav-stacked">
<?php
$type_rs=mysql_query("select * from type");//执行sql语句，得到一个结果集
while($type_row=mysql_fetch_array($type_rs))//遍历结果集
{?>
    <li><a href="others/typeselect.php?type=<?php echo $type_row['type'] ?>"><?php echo $type_row["name"]; ?></a></li>
<?php
}
?>
</ul>
<?php 
//已登录状态的显示（上面）
}else{ 
//未登录状态的显示（下面）
?>
<h3>用户登录</h3>
<form method="post" action="deal/login_check.php"><table>
<tr><td>用户名：</td><td><input type="text" name="user_id" style="width:130px;" /></td></tr>
<tr><td>密码：</td><td><input type="password" name="password"  style="width:130px;"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="login" value="登录" class="btn-primary" /></td></tr>
</table></form>
<?php 
}
?>
</div><!--#middle_left end-->

<div id="middle_right">
<h1 class="font_style2 border1">公告</h1>
<table class="table">
<?php
$rules=mysql_query("select * from rule"); //获得记录总数
$rules_cou=1;
while($rules_rs=mysql_fetch_array($rules)){
?>
<tr class="font_style3"><td style="border:0px;"><!--在这里加个style="border:0px;"可去掉边框-->
<?php 
echo $rules_cou." ".$rules_rs["content"];
$rules_cou=$rules_cou+1;
?>
</td></tr>
<?php } ?>
</table>

<h1 class="border1">帖子一览</h1>
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
//下面均为分页算法内容
$perNumber=20; //每页显示的记录数
$page=$_GET['page']; //获得当前的页面值
$count=mysql_query("select count(*) from item where status='0'"); //获得记录总数
$rs=mysql_fetch_array($count); 
$totalNumber=$rs[0];
$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
if (!isset($page)) {
 $page=1;
} //如果没有值,则赋值1
$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
$result=mysql_query("select * from item where status='0' order by last_modify desc limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数
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
<td><a href="others/item_detail.php?item_id=<?php echo $item_id; ?>"><?php echo $row["title"]; ?></a></td>
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
<!--<a href="index.php?page=1">首页</a>显示首页，尾页也类似-->
<a href="index.php?page=<?php echo $page - 1;?>">上一页</a> <!--显示上一页-->
<?php
}
?>
<?php echo $page; ?>
<?php
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
?>
<a href="index.php?page=<?php echo $page + 1;?>">下一页</a>
<?php
} 
?>
</td>
</tr>
</tbody>
</table>
</div><!--#middle_right end-->

<div class="clear"></div>
</div><!--middle end-->

<div id="footer">
Copyright © 2015 Milly Chen Graduation Design. All rights reserved.<br />
任何问题或反馈请发邮件到：<span style="color:#03F;">NewChangeMan@126.com</span><br />
Managers' <a href="others/notice_mag.php">Home</a>
</div>
</body>
</html>