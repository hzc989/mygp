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
    <li><a href="user_mag.php">用户管理</a></li>
    <li class="active"><a href="#">举报管理</a></li>
    <li><a href="../index.php">返回主页</a></li>
</ul>
</div><!--middle_left end-->
<div id="admin_mid_right">
    <ul class="nav nav-tabs">
    <li class="active"><a href="#">帖子举报</a></li>
    <li><a href="reply_alarm_mag.php">回复举报</a></li>
    </ul>
    
<h1 class="border1">帖子举报
</h1>
<div class="well well_style1">
<?php
$id=$_GET["id"];
$item_alarm_res=mysql_query("select * from item_alarm where id=".$id);
$item_alarm=mysql_fetch_array($item_alarm_res);
 ?>
<form action="../deal/alarm_modify_deal.php" method="post">
<table>
<input type="hidden" name="id" value="<?php echo $item_alarm['id']; ?>" />
<tr><td width="80px">违规原因：</td><td><input type="text" name="reason" style="width:300px;" value="<?php echo $item_alarm['reason'] ?>" /></td></tr>
<tr><td>状态：</td><td>
<?php 
if($item_alarm["status"]=='0'){
?>
<input type="radio" name="status" value="1" />已通过
<input type="radio" name="status" value="0" checked="checked"/>未通过
<?php }else{ ?>
<input type="radio" name="status" value="1" checked="checked" />已通过
<input type="radio" name="status" value="0" />未通过
<?php }　?>
</td></tr>
<tr height="40px"><td colspan="2" align="center">
<input type="submit" value="确认审查" name="item_alarm" class="btn btn-primary" />
<a class="btn" href="item_alarm_mag.php">返回</a>
</td></tr>
</table>
</form>
</div>

</div><!--admin_mid_right end-->

<div class="clear"></div>
</div>

</body>
</html>