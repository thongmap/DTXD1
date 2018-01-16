<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

session_start();
function chuyenso($i)
{
	return number_format($i,0,'.','.');
}
require_once  ('../controllers/home_controller.php');
$homecontroller = new HomeController();
if(!isset($_SESSION['Quyen']) || $_SESSION['Quyen']=='1')
{
	header("location:login.php");
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
<script type="text/javascript" src="../public/js/move-top.js"></script>
<script type="text/javascript" src="../public/js/easing.js"></script>
<script type="text/javascript">
function Checklogout()
{
	var i=0;
	<?php
	$dem=0;
	$checkhm[]=$homecontroller->GetHM_ND($_SESSION['Mand']);
	 foreach($checkhm as $chm):
				for($j=0; $j<count($chm); $j++)
				{
				 	$dem++;
				}
				endforeach;
	 if(isset($_SESSION['cart_products']) || $dem >0)
	{
	echo "if( confirm('Bạn có muốn lưu lại công trình không')== true )
	i=1;
	else"
;	}?>
	if(i ==0)
	window.location="logout.php";
	
}</script>
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
					</li><li><a onClick="Checklogout()">Đăng xuất</a></li>				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
         <div class="logo">
				<a href="user.php"  style="text-decoration:none"><img src="../public/image/dh-sai-gon.jpg" alt=""  width="130" height="100"/><span class="tieude_header">DỰ TOÁN XÂY DỰNG</span></a>
			</div>
			  <div class="cart">
			  	   <p><span>Chào, <a href="user.php"> <?php echo $_SESSION['Tennd']?></a></span></p>
			  </div>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li ><a href="home1.php">Công trình</a></li>
                    <li><a href="haophi.php">Hao Phí Vật Tư</a></li>
                    <li ><a href="vatlieu.php">Vật liệu</a></li>
                    <li class="active"><a href="NC.php">Nhân Công</a></li>
                    <li ><a href="MTC.php">Máy thi Công</a></li>
			    	<li><a href="ChiPhiHM.php">Chi phí hạng mục</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<!--<div class="search_box">
	     		<form method="post" action="home.php">
	     			<input type="text" placeholder="Tìm kiếm" name="tim" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tìm kiếm';}"><input type="submit" value=""><input type="hidden" name="sx" value="1">
	     		</form>
	     	</div>-->
	     	<div class="clear"></div>
	     </div>	     
 <div class="main">
    <div class="content">
    	<div class="content_top">
    <div class="clear"></div>
   
		 <form method="post" action="updatecart.php">

    <div class="clear"></div>
          <div class="content_top">
    		<div class="heading">
    		<h3>Nhân Công</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <table class="table table-bordered table-list table-striped">
		<thead>
        <tr  class="text-center text-uppercase">
        	<td width="3%"><strong>STT</strong></td>
            <td width="10%"><strong>Mã vật liệu</strong></td>
            <td width="30%"><strong>Tên vật liệu</strong></td>
            <td width="8%"><strong>Đơn vị</strong></td>
            <td><strong>Khối lượng</strong></td>
            <td><strong>Đơn giá</strong></td>
            <td><strong>Giá Thông Báo</strong></td>
        </tr>
        </thead>
		 <?php 
		 $kiemtra[] = array();$klhaophi[]=array();
		 		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
				{
				$j=1;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						if(substr($sp1[$i]['mavt'],0,1)=="N" && array_search($sp1[$i]['mavt'],$kiemtra) == false) 
						array_push($kiemtra,$sp1[$i]['mavt']);
					}
				}
				unset($sanpham1);
				}
				for($k = 0;$k<count($kiemtra);$k++)
				{
					array_push($klhaophi,0);
					foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						if($sp1[$i]['mavt'] == $kiemtra[$k]) 
						$klhaophi[$k]+= $sp1[$i]['haophi']*$cart_itm["khoiluong"];
					}
				}
				unset($sanpham1);
				}
				}
				unset($kiemtra);
				$kiemtra[] = array();
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						
						if(substr($sp1[$i]['mavt'],0,1)=="N" && array_search($sp1[$i]['mavt'],$kiemtra) == false )
						{
							array_push($kiemtra,$sp1[$i]['mavt']);
							
					echo '<tr>';
					echo '<td>'.$j.'</td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td>'.$klhaophi[$j++].'</td>';
					echo '<td>'.chuyenso($sp1[$i]['dongia']).'</td>';
					echo '<td><input type="text" style="background-color:transparent;border:0px;" value="'.chuyenso($sp1[$i]['dongia']).'"></input></td>';
					echo '</tr>';
					}
					}
				}
				unset($sanpham1);
				}
			}
		?>  
		</form>	
    </table>
    
				</div>
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

