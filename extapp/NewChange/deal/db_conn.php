<?php session_start();
 $server="localhost";  //mysql服务器地址
 $user="root";         //登陆mysql的用户名
 $password="";          //登陆mysql的密码
 $db_name="newchange";   //mysql中要操作的数据库名
@header("content-type:text/html; charset=utf-8");
 $hd=mysql_connect($server,$user,$password) or die("抱歉，无法连接,请检查连接的用户名和密码");
 $db=mysql_select_db($db_name,$hd) or die("抱歉，无法连接,请检查数据库是否存在");
  mysql_query('set names utf8');   
?>