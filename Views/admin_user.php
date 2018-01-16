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
if(isset($_POST['delngdug']))
{
	$logincontroll->DelUser($_POST['delngdug']);
}
if(isset($_POST['edituser']))
{
	$_SESSION['NguoiDung'] = $_POST['edituser'];
	header("location: admin_edituser.php");
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
            <form method="post" action="admin_user.php">
                <span class="glyphicon glyphicon-search" style="padding:5px"></span>
	     			<input type="text" placeholder="Tìm kiếm" name="tim" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tìm kiếm';}"><input type="submit" value=""><input type="hidden" name="sx" value="1">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	  
  </div>
<div></div><br><br>
            <br><br>
<table class="table table-striped table-bordered table-list">
    <thead>
                    <tr>
                        <th ><center>STT</center></th>
                        <th >Mã người dùng</th>
                        <th >Tên người dùng</th>
                        <th >Email</th>
                        <th ><center>Quyền</center></th>
                        <th ><center>Xóa</center></th>
      </thead>
                  <tbody><form method="post" action="admin_user.php">
                  <?php
				  $j=1;
				   if(!isset($_POST['tim']))
				  $user[]=$logincontroll->GetAlluser();
				  else
				  $user[]=$logincontroll->FindUser($_POST['tim']);
				 foreach($user as $u){
					 for($i = 0;$i<count($u);$i++)
					 {
						 if($_SESSION['Mand'] != $u[$i]['mand'])
						 {
	 ?>
                          <tr>
                           <td><?php echo $j++?></td>
                          	<td><?php echo $u[$i]['mand']?></td>
                            <td><?php echo $u[$i]['tennd']?></td>
                            <td><?php echo $u[$i]['email']?></td>
                            <td><?php echo $u[$i]['phanquyen']?></td>
                            <td class="text-center"><button class="glyphicon glyphicon-remove" type="submit" onClick="return Xoa();" name="delngdug" value="<?php echo $u[$i]['mand']?>" ></button><button class="glyphicon glyphicon-edit" type="submit" name="edituser" value="<?php echo $u[$i]['mand']?>" ></button></td>
                          </tr>
 <?php }}}?>
                        </tbody></form>
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

