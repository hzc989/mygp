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
<title>无标题文档</title>
</head>

<body>
<div id="middle">
<div id="admin_mid_left">
<ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="#">公告管理</a></li>
    <li><a href="user_mag.php">用户管理</a></li>
    <li><a href="item_alarm_mag.php">举报管理</a></li>
    <li><a href="../index.php">返回主页</a></li>
</ul>
</div><!--middle_left end-->

<div id="admin_mid_right">
<h1>公告管理
<span style="float:right;"><a class="btn btn-primary" data-toggle="modal" href="#NewNotice" >+新建</a></span>
</h1>
<table class="table">
<?php
$rules=mysql_query("select * from rule"); //获得记录总数
while($rules_rs=mysql_fetch_array($rules)){
?>
<tr class="font_style3"><td width="80%">
<?php 
echo $rules_rs["content"];
?>
</td>
<!--修改模态框start-->
<div class="modal hide" id="ModifyNotice<?php echo $rules_rs['id']; ?>">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>修改公告</h3>
    </div><!--模态框头部end-->
    <form action="../deal/notice_modify.php" method="post">
    <input type="hidden" name="id" value="<?php echo $rules_rs['id']; ?>" />
    <div class="modal-body">
    公告内容：
    <textarea rows="3" name="content" style="width:400px;"><?php echo $rules_rs["content"]; ?></textarea>
    </div><!--模态框body部分 end-->
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" name="submit" class="btn btn-primary" value="提交">
    </div><!--模态框footer部分 end-->
    </form>
</div>
<!--修改模态框end-->
<td width="10%"><a class="btn btn-info" data-toggle="modal" href="#ModifyNotice<?php echo $rules_rs['id']; ?>" >修改</a></td>
<td width="10%"><a class="btn" href="../deal/notice_delete.php?id=<?php echo $rules_rs['id']; ?>">删除</a></td>
</tr>
<?php } ?>
</table>
<!--新建公告模态框 start-->
<div class="modal hide" id="NewNotice">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>新建公告</h3>
    </div><!--模态框头部end-->
    <form action="../deal/notice_add.php" method="post">
    <div class="modal-body">
    <table>
    <td>公告内容：</td>
    <td><textarea rows="3" name="content" style="width:400px;"></textarea></td>
    </table>
    </div><!--模态框body部分 end-->
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" name="submit" class="btn btn-primary" value="提交">
    </div><!--模态框footer部分 end-->
    </form>
</div>
<!--新建公告模态框 end-->

</div><!--admin_mid_right end-->

<div class="clear"></div>
</div>

</body>
</html>