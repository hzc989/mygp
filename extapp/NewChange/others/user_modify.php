<?php include ("../deal/admin_check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/bootstrap/css/bootstrap.min.css"  type="text/css" rel="stylesheet" />
<link href="../style/style.css" type="text/css" rel="stylesheet" />
<script src="../style/bootstrap/js/bootstrap.min.js"></script>
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
<h1 class="border1">用户管理</h1>
<div class="well well_style1">
<form method="post" action="../deal/user_modify_deal.php">
<table>
<?php 
$user_id=$_GET["user_id"];
$res=mysql_query("select * from user where user_id=".$user_id);//执行sql语句，得到一个结果集
$user_list=mysql_fetch_array($res);//遍历结果集,取一个值
?>
<tr><td width="20%"><strong>用户名：</strong></td>
<td><?php echo $user_id; ?><input type="hidden" value="<?php echo $user_id; ?>" name="user_id" /></td></tr>
<tr><td><strong>密码：</strong></td><td><input type="password" name="password" /><span class="font_style3" style="font-size:12px;">*不修改则不填</span></td></tr>
<tr><td><strong>用户类型：</strong></td>
<td>
<?php
if($user_list["user_type"]=='0'){ ?> 
<input type="radio" name="user_type" value="0" checked="checked"/>管理员
<input type="radio" name="user_type" value="1"/>普通用户
<?php
}else{?>
<input type="radio" name="user_type" value="0"/>管理员
<input type="radio" name="user_type" value="1" checked="checked"/>普通用户
<?php } ?>
</td>
</tr>
<tr><td><strong>警告次数：</strong></td><td><input type="text" name="alarm" value="<?php echo $user_list['alarm']; ?>" /></td></tr>
<tr><td><strong>状态</strong></td>
<td>
<?php
if($user_list["status"]=='0'){ ?> 
<input type="radio" name="status" value="0" checked="checked"/>正常
<input type="radio" name="status" value="1"/>禁言
<?php
}else{?>
<input type="radio" name="status" value="0"/>正常
<input type="radio" name="status" value="1" checked="checked"/>禁言
<?php } ?>
</td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-info" value="确定" />&nbsp;&nbsp;
<a href="user_mag.php" class="btn">返回</a></td></tr>
</table>
</form>
</div><!--well end-->
</div>

<div class="clear"></div>
</div>

</body>
</html>