<?php
session_start();
require_once("../controllers/login_controller.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
    <link rel="stylesheet" href="../public/css/style_login.css" media="screen" type="text/css" />
</head>
<body>
  <div class="login-card">
    <h1>Đăng nhập</h1><br>
  <form method="post">
    <input type="text" name="user" placeholder="Tên tài khoản">
    <input type="password" name="pass" placeholder="Mật khẩu">
    <input type="submit" name="login" class="login login-submit" style="width:48%" value="Đăng nhập">&nbsp;&nbsp;<input formaction="register.php" style="width:48%" type="submit" name="login" class="login login-submit" value="Đăng kí">
    <?php
	if(isset($_POST['login']))
{
	if(isset($_POST['user']) && isset($_POST['pass']))
	{
		$name = $_POST['user'];
        $pass =	$_POST['pass'];
		if($name!="" && $pass!="")
		{
			$login= new LoginController();
			if($login->Login($name,$pass)==1)
			{
				if($_SESSION['Quyen']==2)
					header("location:user.php");
					if($_SESSION['Quyen']==1)
					header("location:Admin_danhmuc.php");

			}
			if($login->Login($name,$pass)==0)
			{
				echo "<p align='center'>Tên tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại.</p>";
			}
		}
    }
}
	?>
  </form>
  
</div>
</body>
</html>