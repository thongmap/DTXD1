<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
require_once  ('../controllers/login_controller.php');
$logincontroll = new LoginController();
$username[]=$logincontroll->GetAlluser();
if(isset($_POST['submit']))
{  
			$logincontroll->ThemNgDug($_POST['ho'],$_POST['pass'],2,$_POST['email']);
		header("location: login.php");
		
	
	
}
?>
<!DOCTYPE HTML>
<head>
<title>Dự Toán PhaTi</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="../public/css/jquerysctipttop.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../public/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.css">

<script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="../public/js/jquery.min.js"></script>
<script type="text/javascript">
function kiemtra()
{
	if(document.getElementById('ho').value.length <=0 )
	{
		alert("Nhập tên ");
		return false;
	}
	if(document.getElementById('email').value.length <=0 )
	{
		alert("Nhập địa chỉ e-mail ");
		return false;
	}
	if(document.getElementById('pass').value.length <=0)
	{
		alert("Nhập password");
		return false;
	}
	if(document.getElementById('pass').value != document.getElementById('pass1').value)
	{
		alert("Sai mật khẩu");
		return false;
		
	} 
	<?php foreach($username as $u)
	for($i =0;$i<count($u);$i++)
	{
		echo "if(document.getElementById('ho').value == '". $u[$i]['tennd']."' )
		{
			alert('Tên người dùng đã có người sử dụng');
			return false;		
		}";
	}?> 
		alert("Đăng kí thành công");
		return true;
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
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
         <div class="logo">
				<img src="../public/image/dh-sai-gon.jpg" alt=""  width="130" height="100"/>
			</div>
			  <div class="cart">
			  </div>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
    <div class="menu">
	     		<ul>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     
 <div class="main">
 
    <div class="content">
    	<div class="content_top text-center">
            <h3> ĐĂNG KÍ </h3>
</div>
    <div class="clear"></div>
 <div class="clear"></div>
                        <form role="form" method="post">

                            <div class="form-group">
				<table width="100%">
				<tr>
				<td><label>Tên người dùng:</label></td>
				<td><input type="text" class="form-control" name="ho" id="ho"></td>
 				</tr>
                </tr><tr height="10px"></tr>
				<tr>
	                        <td><label>Mật khẩu:</label></td>
	                        <td><input type="password" name="pass" class="form-control" id="pass" /></td>
				</tr>
                </tr><tr height="10px"></tr>
				<tr>
	                        <td><label>Nhập lại mật khẩu:</label></td>
	                        <td><input type="password" name="pass1" class="form-control" id="pass1"  /></td>
				</tr>
                </tr><tr height="10px"></tr>
				<tr>
	                        <td><label>E-mail:</label></td>
	                        <td><input type="textfield" name="email" class="form-control" id="email" /></td>
				</tr>
				<tr height="10px"></tr>
       <tr><td></td>
       <td>
       <button type="submit" name="submit" class="btn btn-default" onClick="return kiemtra();">Đăng kí</button>
                            <button type="reset" class="btn btn-default">Làm lại</button></td>
                            </tr>
                            </table>
    </div>
                        </form>

    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrap">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
					
							<h4>Theo dõi chúng tôi</h4>
                            <div class="social-icons">
					   		  <ul>
							      <li><a href="#" target="_blank"><img src="../public/image/social media/fb.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="../public/image/social media/g.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="../public/image/social media/in.png" alt="" /> </a></li>
							      <li><a href="#" target="_blank"> <img src="../public/image/social media/tw.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"> <img src="../public/image/social media/you.png" alt="" /></a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên Hệ</h4>
						<ul>
							<li><span>+91-123-456789</span></li>
							<li><span>+00-123-000000</span></li>
						</ul>
						
				</div>
			</div>			
        </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

