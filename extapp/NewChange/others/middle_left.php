<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div id="middle_left">
<?php
if(isset($_SESSION['user_id'])){
?>
<h3>个人中心</h3>
<ul class="nav nav-tabs nav-stacked">
<li><a href="../index.php">首页</a></li>
<li>
<a href="myitem.php">我的帖子</a>
</li>
<li>
<?php 
$alarm_rs=mysql_query("select * from user where user_id=".$_SESSION['user_id']);//执行sql语句，得到一个结果集
$alarm_row=mysql_fetch_array($alarm_rs)//遍历结果集,取一个值
?>
<a href="myalarm.php">违规记录(<?php echo $alarm_row["alarm"]; ?>)</a>
</li>
<li>
<a href="../deal/log off.php">退出登录</a>
</li>
</ul>
<h3>帖子汇总</h3>
<ul class="nav nav-tabs nav-stacked">
<?php
$type_rs=mysql_query("select * from type");//执行sql语句，得到一个结果集
while($type_row=mysql_fetch_array($type_rs))//遍历结果集
{?>
    <li><a href="typeselect.php?type=<?php echo $type_row['type']; ?>"><?php echo $type_row["name"]; ?></a></li>
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
<form method="post" action="../deal/login_check.php"><table>
<tr><td>用户名：</td><td><input type="text" name="user_id" style="width:130px;" /></td></tr>
<tr><td>密码：</td><td><input type="password" name="password"  style="width:130px;"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="login" value="登录" class="btn-primary" /></td></tr>
</table></form>
<?php 
}
?>
</div><!--#middle_left end-->
</body>
</html>