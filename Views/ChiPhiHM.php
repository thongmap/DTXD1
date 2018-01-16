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
$homecontroller=new HomeController();
if(!isset($_SESSION['Quyen']) || $_SESSION['Quyen']=='1')
{
	header("location:login.php");
}$chitruc=0;
$chichung=0;
$Gtt=0;
$GTGT =0;
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
					</li><li><a onClick="Checklogout()">Đăng xuất</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
         <div class="logo">
				<a href="user.php"  style="text-decoration:none"><img src="../public/image/dh-sai-gon.jpg" alt=""  width="130" height="100"/><span class="tieude_header">DỰ TOÁN XÂY DỰNG</span></a>
			</div>
			  <div class="cart">
			  	   <p><span>Chào,<a href="user.php"> <?php echo $_SESSION['Tennd']?></a></span></p>
			  </div>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li ><a href="home1.php">Công trình</a></li>
                    <li><a href="haophi.php">Hao Phí Vật Tư</a></li>
                    <li ><a href="vatlieu.php">Vật liệu</a></li>
                    <li><a href="NC.php">Nhân Công</a></li>
                    <li ><a href="MTC.php">Máy thi Công</a></li>
			    	<li  class="active"><a href="ChiphiHM.php">Chi phí hạng mục</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
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
    		<h3>Bảng tổng hợp kinh phí hạng mục</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <table class="table table-bordered table-list table-striped">
		<thead>
        <tr class="text-center">
        	<td width="3%"><strong>STT</strong></td>
            <td ><strong>KHOẢN MỤC CHI PHÍ</strong></td>
            <td ><strong>KÝ HIỆU</strong></td>
            <td ><strong>CÁCH TÍNH</strong></td>
            <td><strong>THÀNH TIỀN</strong></td>
        </tr>
        </thead>
		<tbody>
        <tr class="text-uppercase">
        <td class="text-left"><strong>I</strong></td>
        <td><strong>Chi phí trực tiếp</strong></td>
        <td></td>
        <td></td>
        <td ></td>
        </tr>
        <tr>
        <td class="text-center">1</td>
        <td>Chi phí vật liệu</td>
        <td class="text-center">VL</td>
        <td>hsvl</td>
        <td class="text-right" ><?php if($_SESSION['tongvl']>0)echo chuyenso($_SESSION['tongvl'])?></td>
        </tr>
        <tr>
        <td class="text-center">2</td>
        <td>Chi phí nhân công</td>
        <td class="text-center">NC</td>
        <td>hsnc</td>
        <td class="text-right" ><?php if($_SESSION['tongnc']>0)echo chuyenso($_SESSION['tongnc'])?></td>
        </tr>
        <tr>
        <td class="text-center">3</td>
        <td>Chi phí máy thi công</td>
        <td class="text-center">M</td>
        <td>hsm</td>
        <td class="text-right" ><?php if($_SESSION['tongmay']>0)echo chuyenso($_SESSION['tongmay'])?></td>
        </tr>
         <tr>
        <td class="text-center">4</td>
        <td>Trực tiếp phí khác</td>
        <td class="text-center">TT</td>
        <td>(VL + NC + M)x1.5%</td>
        <td class="text-right" ><?php if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)echo chuyenso(($_SESSION['tongmay']+$_SESSION['tongvl']+$_SESSION['tongnc'])*0.015)?></td>
        </tr>
        <tr>
        <td class="text-center"></td>
        <td><em><strong>Cộng chi phí trực tiếp</strong></em></td>
        <td class="text-center"><strong>T</strong></td>
        <td><strong>VL + NC + M + TT</strong></td>
        <td class="text-right" >
		<strong><?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso(($_SESSION['tongmay']+$_SESSION['tongvl']+$_SESSION['tongnc'])*0.015 + $_SESSION['tongmay']+$_SESSION['tongvl']+$_SESSION['tongnc']);
		$chitruc = ($_SESSION['tongmay']+$_SESSION['tongvl']+$_SESSION['tongnc'])*0.015 + $_SESSION['tongmay']+$_SESSION['tongvl']+$_SESSION['tongnc'];
		}
		?></strong></td>
        </tr>
        <tr>
        <td ><strong>II</strong></td>
        <td class="text-uppercase"><strong>Chi phí chung </strong></td>
        <td class="text-center">C</td>
        <td>T x 5%</td>
        <td class="text-right" >
		<?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($chitruc * 0.05);
		$chichung = $chitruc * 0.05;
		}
		?></td>
        </tr>
        </tr>
        <tr>
        <td><strong>III</strong></td>
        <td class="text-uppercase"><strong>Tỷ lệ thuế tính trước </strong></td>
        <td class="text-center">TL</td>
        <td>(T + C )x 5,5%</td>
        <td class="text-right" >
		<?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso(($chitruc+$chichung) * 0.055);
		}
		?></td>
        </tr>
        </tr>
        <tr>
        <td class="text-center"></td>
        <td><strong><em>Chi phí xây dựng trước thuế</em> </strong></td>
        <td class="text-center"><strong>Gtt</strong></td>
        <td><strong>T + C + TL</strong></td>
        <td class="text-right" >
		<strong><?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($chitruc + $chichung + ($chitruc+$chichung) * 0.055);
		$Gtt=$chitruc + $chichung + ($chitruc+$chichung) * 0.055;
		}
		?></strong></td>
        </tr>
         </tr>
        <tr>
        <td><strong>IV</strong></td>
        <td class="text-uppercase"><strong>Thuế giá trị gia tăng </strong></td>
        <td class="text-center">GTGT</td>
        <td>Gtt x 10%</td>
        <td class="text-right" >
		<?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($Gtt *0.1);
		$GTGT = $Gtt * 0.1;
		}
		?></td>
        </tr>
        <tr>
        <td></td>
        <td><strong><em>Chi phí xây dựng sau thuế</em> </strong></td>
        <td class="text-center"><strong>Gst</strong></td>
        <td><strong>Gtt + GTGT</strong></td>
        <td class="text-right" >
		<strong><?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($Gtt + $GTGT);
		}
		?></strong></td>
        </tr>
        <tr>
        <td><strong>V</strong></td>
        <td class="text-uppercase"><strong>Chi phí lán trại, nhà tạm </strong></td>
        <td class="text-center">Gxdnt</td>
        <td>Gtt x ( 1+10% ) x 1%</td>
        <td class="text-right" >
		<?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($Gtt *(1+0.1)*0.01);
		}
		?></td>
        </tr>
         <tr>
        <td><strong></strong></td>
        <td ><strong>Tổng cộng</strong> </td>
        <td class="text-center"><strong>Gxd</strong></td>
        <td><strong>Gst + Gxdnt</strong></td>
        <td class="text-right" >
		<strong><?php  
		if($_SESSION['tongmay']>=0 && $_SESSION['tongvl']>=0 && $_SESSION['tongnc']>=0)
		{
		echo chuyenso($Gtt *(1+0.1)*0.01 + $Gtt + $GTGT);
		}
		?></strong></td>
        </tr>
        </tbody>	
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

