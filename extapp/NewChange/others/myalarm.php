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

    <div class="tabbable" style="margin-bottom: 9px;">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#1" data-toggle="tab">帖子违规</a></li>
          <li class=""><a href="#2" data-toggle="tab">回复违规</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="1">
            <!--1中内容-->
            <h1 class="border1">帖子违规</h1>
            <table class="table">
            <thead>
            <tr>
            <th width="12%">种类</th>
            <th width="70%">原帖标题</th>
            <th width="18%">详情查看</th>
            </tr>
            </thead>
            <tbody>
            <?php 
			$rs=mysql_query("select * from item where status='1' and author=".$_SESSION['user_id']);//执行sql语句，得到一个结果集
            while($row=mysql_fetch_array($rs))//遍历结果集
            {
			 ?>
            <tr>
            <td><?php
			$type_res=mysql_query("select * from type where type=".$row["type"]);//执行sql语句，得到一个结果集
            $type_list=mysql_fetch_array($type_res);//遍历结果集,取一个值
            echo $type_list["name"];
			?></td>
            <td>
            <a href="item_detail.php?item_id=<?php echo $row["item_id"]; ?>"><?php echo $row["title"]; ?></a>
            </td>
            <td><a class="btn" data-toggle="modal" href="#ItemModal<?php  echo $row['item_id']; ?>" >查看</a></span></td><!--此处modal框要建多个，因为id值是唯一的，因此建多个调用才能不一样-->
            <!--模态框开始-->
    <div class="modal hide" id="ItemModal<?php  echo $row['item_id']; ?>">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>详情查看</h3>
    </div>
    <div class="modal-body">
    <p><strong>违规原因查看：</strong>
	<?php 
	$reason_res=mysql_query("select * from item_alarm where item_id=".$row["item_id"]);//执行sql语句，得到一个结果集
    $reason_list=mysql_fetch_array($reason_res);//遍历结果集,取一个值
    echo $reason_list["reason"];
	?></p>
    </div>
    </div>
          <!--模态框结束-->
            </tr>
            <?php } ?>
            </tbody>
            </table>
          </div><!--模块1内容结束-->
          
          
          <div class="tab-pane" id="2">
            <!--2中内容-->
            <h1 class="border1">回复违规</h1>
            <table class="table">
            <thead>
            <tr>
            <th width="12%">种类</th>
            <th width="70%">原帖标题</th>
            <th width="18%">详情查看</th>
            </tr>
            </thead>
            <tbody>
            <?php 
			$rs=mysql_query("select * from reply where status='1' and replier=".$_SESSION['user_id']);//执行sql语句，得到一个结果集
            while($row=mysql_fetch_array($rs))//遍历结果集
            {
			 ?>
            <tr>
            <td><?php
			$item_res=mysql_query("select * from item where item_id=".$row["item_id"]);//执行sql语句，得到一个结果集
            $item_list=mysql_fetch_array($item_res);//遍历结果集,取一个值
            $type_res=mysql_query("select * from type where type=".$item_list["type"]);//执行sql语句，得到一个结果集
            $type_list=mysql_fetch_array($type_res);//遍历结果集,取一个值
			echo $type_list["name"];
			?></td>
            <td>
            <a href="item_detail.php?item_id=<?php echo $row["item_id"]; ?>"><?php echo $item_list["title"]; ?></a>
            </td>
            <td><a class="btn" data-toggle="modal" href="#ReplyModal<?php  echo $row['reply_id']; ?>" >查看</a></span></td><!--此处modal框要建多个，因为id值是唯一的，因此建多个调用才能不一样-->
            <!--模态框开始-->
    <div class="modal hide" id="ReplyModal<?php  echo $row['reply_id']; ?>">
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>详情查看</h3>
    </div>
    <div class="modal-body">
    <p><strong>回复内容：</strong>
	<?php echo $row["content"]; ?></p>
    <p><strong>违规原因查看：</strong>
	<?php 
	$reason_res=mysql_query("select * from reply_alarm where reply_id=".$row["reply_id"]);//执行sql语句，得到一个结果集
    $reason_list=mysql_fetch_array($reason_res);//遍历结果集,取一个值
    echo $reason_list["reason"];
	?></p>
    </div>
    </div>
          <!--模态框结束-->
            </tr>
            <?php } ?>
            </tbody>
            </table>
          </div><!--模块2内容结束-->
        </div>
      </div>

</div><!--middle_right end-->
<div class="clear"></div>
</div>

<?php include("footer.php"); ?>

</body>
</html>