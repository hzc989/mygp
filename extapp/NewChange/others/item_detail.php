<?php include ("../deal/db_conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../style/bootstrap/js/jquery.min.js"></script>
<script src="../style/bootstrap/js/bootstrap-tab&modal.js"></script>
<script type = "text/javascript" language = "javascript">
  function delete_item(obj)
  {
   if(confirm("确定删除该帖子及它的所有回复?"))
    	{
    		location.href="../deal/item_delete.php?item_id="+obj;
    	}else{
    		return false;
    	}
  }
  function delete_reply(obj)
  {
   if(confirm("确定删除该回复?"))
    	{
    		location.href="../deal/reply_delete.php?reply_id="+obj;
    	}else{
    		return false;
    	}
  }
 </script>
<title>无标题文档</title>
</head>

<body>
<?php
include("header.php");
?>
<div id="middle">
<?php include("middle_left.php"); ?>

<div id="middle_right">
<?php
$item_id=$_GET['item_id'];
$res=mysql_query("select * from item where item_id=".$item_id);//执行sql语句，得到一个结果集
$list=mysql_fetch_array($res);//遍历结果集,取一个值
?>
    <div class="alert alert-info">
    <p align="right">
	<?php echo "<strong>发帖ID：</strong>".$list["author"].
	"&nbsp;&nbsp;&nbsp;<strong>发帖时间：</strong>".$list["time"]; ?></p>
    <pre class="pre_style1"><?php echo $list["content"]; ?></pre>
    <?php
	if($list["attachment"]!=null){
	?>
    <strong>附件：</strong><a href="<?php echo $list["attachment"]; ?>"><?php echo basename($list["attachment"]); //basename($list["attachment"]) ?></a>
    <?php } ?>
    </pre>
    <p align="right">
	<?php 
	if($list["author"]==$_SESSION['user_id']){
	?>
    <a href="item_modify.php?item_id=<?php echo $item_id; ?>">修改</a>&nbsp;&nbsp;&nbsp;
    <a onclick="delete_item(<?php echo $item_id; ?>)">删除</a>
    <?php
	}else{ ?>
    <a data-toggle="modal" href="#itemalarm_Modal">举报</a>
    <?php } ?>
    </p>
    </div><!--item项 end-->
    
    <h4>回复
    <span style="float:right;"><a data-toggle="modal" href="#replyadd_Modal" >+新建回复</a></span>
    </h4>
<?php //回复项开始
$perNumber=10; //每页显示的记录数
$page=$_GET['page']; //获得当前的页面值
$count=mysql_query("select count(*) from reply where status='0' and item_id=".$item_id); //获得记录总数
$rs=mysql_fetch_array($count); 
$totalNumber=$rs[0];
$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
if (!isset($page)) {
 $page=1;
} //如果没有值,则赋值1
$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
$reply_num=1;
$result=mysql_query("select * from reply where status='0' and item_id=".$item_id." limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数
while ($row=mysql_fetch_array($result)) {
  //显示数据库的内容
 ?>
 <div class="alert">
    <p align="right"><span style="float:left;"><?php echo $startCount+$reply_num;$reply_num=$reply_num+1; ?>楼</span>
	<?php echo "<strong>回复ID：</strong>".$row["replier"].
	"&nbsp;&nbsp;&nbsp;<strong>发帖时间：</strong>".$row["time"]; ?></p>
    <pre class="pre_style1"><?php echo $row["content"]; ?>
    </pre>
    <p align="right">
	<?php 
	if($row["replier"]==$_SESSION['user_id']){
	?>
    <a onclick="delete_reply(<?php echo $row['reply_id'];?>)">删除</a>
    <?php
	}else{ ?>
    <a data-toggle="modal" href="#replyalarm_Modal<?php echo $row['reply_id']; ?>">举报</a>
    <div class="modal hide" id="replyalarm_Modal<?php echo $row['reply_id']; ?>"><!--replyalarm_Modal模态框开始，此处id需与上面#id中的一致-->
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>回复举报</h3>
    </div>
    <?php 
	if(!isset($_SESSION['user_id'])){ ?>
    <div class="modal-body">
    <p>请先登录！</p>
    </div>
    <?php }else{ ?>
    <form method="post" action="../deal/reply_alarm.php">
    <div class="modal-body">
    举报原因：
    <input type="text" name="reason" style="width:500px;" />
    <input type="hidden" name="reply_id" value="<?php echo $row["reply_id"]; ?>" />
    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
    <input type="hidden" name="owner" value="<?php echo $row["replier"]; ?>" />
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" class="btn btn-primary" value="提交" name="reply_alarm">
    </div>
    </form>
    <?php } ?>
    </div><!--replyalarm_Modal模态框end-->
    
    <?php } ?>
    </p>
    </div>
    <p align="center">
 <?php
}
if ($page != 1) { //页数不等于1
?>
<a href="item_detail.php?page=1&item_id=<?php echo $item_id; ?>">首页</a><!--回到首页-->
<a href="item_detail.php?page=<?php echo $page - 1;?>&item_id=<?php echo $item_id; ?>">上一页</a> <!--显示上一页-->
<?php
}
?>
<?php if($totalNumber!=0) echo $page."&nbsp;"; ?>
<?php
if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
?>
<a href="item_detail.php?page=<?php echo $page + 1;?>&item_id=<?php echo $item_id; ?>">下一页</a>
<a href="item_detail.php?page=<?php echo $totalPage;?>&item_id=<?php echo $item_id; ?>">尾页</a><!--去尾页-->
<?php
} 
?>
  </p>  
    
</div><!--middle_right end-->

<div class="modal hide" id="replyadd_Modal"><!--reply_add模态框开始，此处id需与上面#id中的一致-->
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>新建回复</h3>
    </div>
    <?php 
	if(!isset($_SESSION['user_id'])){ ?>
    <div class="modal-body">
    <p>请先登录！</p>
    </div>
    <?php }else{ ?>
    <form method="post" action="../deal/reply_add.php">
    <div class="modal-body">
    回复内容：
    <textarea rows="3" name="content" style="width:400px;"></textarea>
    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" class="btn btn-primary" value="提交" name="reply_add">
    </div>
    </form>
    <?php } ?>
    </div><!--reply_add模态框end-->

<div class="modal hide" id="itemalarm_Modal"><!--itemalarm_Modal模态框开始，此处id需与上面#id中的一致-->
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>帖子举报</h3>
    </div>
    <?php 
	if(!isset($_SESSION['user_id'])){ ?>
    <div class="modal-body">
    <p>请先登录！</p>
    </div>
    <?php }else{ ?>
    <form method="post" action="../deal/item_alarm.php">
    <div class="modal-body">
    举报原因：
    <input type="text" name="reason" style="width:400px;" />
    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
    <input type="hidden" name="owner" value="<?php echo $list['author']; ?>" />
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <input type="submit" class="btn btn-primary" value="提交" name="item_alarm">
    </div>
    </form>
    <?php } ?>
    </div><!--itemalarm_Modal模态框end-->

<div class="clear"></div>
</div>
<?php include("footer.php"); ?>

</body>
</html>