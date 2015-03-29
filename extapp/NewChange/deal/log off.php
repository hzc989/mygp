<?php session_start(); ?>
<?php
unset($_SESSION['user_id']);
echo '<script language="javascript">location.href="../index.php"</script>' ; ?>
