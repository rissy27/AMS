<?php

session_start();

session_destroy();

echo "<script type='text/javascript'>alert('LogOut Successfully!');
				  document.location='../admin/admin_login.php'</script>";

?>