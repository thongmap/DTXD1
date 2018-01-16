<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
require_once  ('../controllers/login_controller.php');
$logincontroll = new LoginController();
if(!isset($_SESSION['Quyen']) || $_SESSION['Quyen']==2)
{
	header("location:login.php");
}
if(isset($_POST['Edit']))
{
	$logincontroll->EditUser($_SESSION['NguoiDung'],$_POST['name'],$_POST['email'],$_POST['quyen']);
	header("location: admin_user.php");
}
 ?>
<!DOCTYPE HTML>
<head>
  <?php
	
/*// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=codelution-export.xls");
 
// Add data table
include 'Admin_dongia.php';*/
?>
<title>Dự Toán PhaTi</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../public/css/style.css">
<script type="text/javascript" src="../public/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
function Xoa()
{
	return confirm("Bạn có muốn xóa người dùng này ?");
}
</script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
				 <p><span>Trợ giúp?</span> Gọi chúng tôi: <span class="number">1-22-3456789</span></span></p>
			</div>
			<div class="account_desc">
				<ul>
					<li><a href="logout.php">Đăng xuất</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
        <div class="header_top">
        <div class="logo">
				<a href="Admin_danhmuc.php"  style="text-decoration:none"><img src="../public/image/dh-sai-gon.jpg" alt=""  width="130" height="100"/><span class="tieude_header">DỰ TOÁN XÂY DỰNG</span></a>
			</div>
			  <div class="cart">
			  	   <p><span>Chào, <?php echo $_SESSION['Tennd']?></span></p>
			  </div>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu" style="height:100%">
	     		<ul>
			    	<li ><a href="Admin_danhmuc.php">Danh mục</a></li>
                    <li ><a href="Admin_dongia.php">Đơn Giá</a></li>
                    <li class="active"><a href="admin_user.php"  style="width:10em">Người dùng</a></li>
			    	
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box text-center">
	     	</div>
            <?php $user[]=$logincontroll->GetUser_MaND($_SESSION['NguoiDung']);?>
	     	<div class="clear"></div>
	     </div>	  
  </div>
<div>SỬA NGƯỜI DÙNG</div><br><br>
            <br><br>
            <table width="100%" class="table table-bordered">
                  <form method="post" action="admin_edituser.php">
                  <?php
				 foreach($user as $u){
					 for($i = 0;$i<count($u);$i++)
					 {
	 ?>
                          <tr>
                           <td>Tên người dùng</td>
                          	<td><input type="text" style="width:50%" name="name" value="<?php echo $u[$i]['tennd']?>"></td></tr>
                          <tr>
                           <td>Email</td>
                          	<td><input type="text" style="width:50%" name="email" value="<?php echo $u[$i]['email']?>"></td></tr>
                          <tr>
                           <td>Phân quyền</td>
                          	<td><select id="quyen" style="width:50%" name="quyen"><option value="1" <?php if($u[$i]['phanquyen'] ==1 )echo "selected";?> >1</option>
                            <option value="2" <?php if($u[$i]['phanquyen'] ==2 )echo "selected";?> >2</option></td></tr>
                            
                           </tr>
 <?php }}?>
                       <tr>
                        <td><button class="btn btn-default text-right" type="submit" id="Edit" name="Edit">OK</button></td></tr></form>
                        </table>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

