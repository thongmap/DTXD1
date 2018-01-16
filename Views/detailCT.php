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
}
if(isset($_POST['delCongT']))
{
	$homecontroller->DeleteCongtrinh($_POST['delCongT']);
	header("location:user.php");
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
	$dem1 =0;
	$checkhm[]=$homecontroller->GetHM_ND($_SESSION['Mand']);
	 foreach($checkhm as $chm):
				for($j=0; $j<count($chm); $j++)
				{
				 	$dem1++;
				}
				endforeach;
	 if(isset($_SESSION['cart_products']) || $dem1 >0)
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
			  	   <p><span>Chào,<a href="user.php"> <?php echo $_SESSION['Tennd']?></a></span></p>
			  </div>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     	</div>
	     	<div class="clear"></div>
	     </div>	    	     
 <div class="main">
    <div class="content">
    	<div class="content_top">
    <div class="clear"></div>
   
		<?php if(isset($_POST['detailsCongT']))
		{
			$congtrinh[]=$homecontroller->GetCT_MaCT($_POST['detailsCongT'],$_SESSION['Mand']);
			foreach($congtrinh as $ct){
			for($i=0; $i<count($ct); $i++)
				{
			?>
    		<div class="heading">
    		<h3>Chi tiết Công trình :<?php echo $ct[$i]['tenct'];?></h3>
            <h3>Tổng kinh phí Công trình :<?php echo chuyenso($ct[$i]['tongcong']);?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
            <div>
        <?php
		 $homecontroller1=new HomeController();
		 $hangmuc[]=$homecontroller1->GetHM_MaCT($_POST['detailsCongT']);
		foreach($hangmuc as $hm){
				for($j=0; $j<count($hm); $j++)
				{
					?>
        
            <br><br>
    		<span class="text-uppercase"><h3>Tên hạng mục :<?php echo $hm[$j]['tenhm'];?></h3>
            <h3>Tổng kinh phí hạng mục :<?php echo chuyenso($hm[$j]['thanhtienvl']+$hm[$j]['thanhtienmay']+$hm[$j]['thanhtiennc']);?></h3></span>
            <br><br>
        <table class="table table-bordered table-list table-striped">
		<thead>
        <tr>
        	<td rowspan="2">STT</td>
            <td rowspan="2">Mã Danh mục công tác</td>
            <td rowspan="2">Tên Công tác</td>
            <td rowspan="2">Đơn vị</td>
            <td rowspan="2">Khối lượng</td>
            <td colspan="3">Thành tiền</td>
        </tr>
        <tr>
        	<td>Vật liệu</td>
            <td>Nhân Công</td>
            <td>Máy thi công</td>
        </tr>
        </thead>
		 <?php 
		 $dem=1;
		 $homecontroller2=new HomeController();
		 $cthm[]=$homecontroller2->GetCTHM_MaHM($hm[$j]['mahm']);
		foreach($cthm as $chit){
				for($k=0; $k<count($chit); $k++)
				{
					echo '<tr>';
					echo '<td>'.$dem++.'</td>';
					echo '<td>'.$chit[$k]['macv'].'</td>';
					echo '<td>'.$chit[$k]['tencv'].'</td>';
					echo '<td>'.$chit[$k]['donvi'].'</td>';
					echo '<td>'.$chit[$k]['khoiluong'].'</td>';
					echo '<td>'.$chit[$k]['thanhtienvl'].'</td>';
					echo '<td>'.$chit[$k]['thanhtiennc'].'</td>';
					echo '<td>'.$chit[$k]['thanhtienm'].'</td>';
					echo '</tr>';
					}
				}unset($cthm);
					echo '<tr>';
					echo '<td colspan="5">Tổng cộng</td>';
					echo '<td>'.$hm[$j]['thanhtienvl'].'</td>';
					echo '<td>'.$hm[$j]['thanhtiennc'].'</td>';
					echo '<td>'.$hm[$j]['thanhtienmay'].'</td>';
					echo '</tr>';?></table>
                    
                    <span class="text-uppercase"><h3>Hao phí hạng mục :<?php echo $hm[$j]['tenhm'];?></h3></span>
					<table class="table table-bordered table-list table-striped">
					<thead>
        			<tr>
        				 <th rowspan="2"><center>STT</center></th>
                        <th rowspan="2"><center>Mã hiệu</center></th>
                        <th rowspan="2"><center>Tên công tác</center></th>
                        <th rowspan="2"><center>Đơn vị</center></th>
                        <th rowspan="2"><center>Khối lượng</center></th>
                        <th colspan="3"><center>Mức Hao Phí</center></th>
                        <th colspan="3"><center>Khối lượng hao phí</center></th>
                        </tr>
                        <tr>
                        <th><center>Vật liệu</center></th>
                        <th><center>Nhân Công</center></th>
                        <th><center>Máy</center></th>
                        <th><center>Vật liệu</center></th>
                        <th><center>Nhân Công</center></th>
                        <th><center>Máy</center></th>
                    </tr>
        	        </thead><?php 
					$m=1;
					$cthm[]=$homecontroller2->GetCTHM_MaHM($hm[$j]['mahm']);
				foreach($cthm as $chit){
				for($k=0; $k<count($chit); $k++)
				{
					$demvl=0;$demnv =0;$demmay =0;
					echo '<tr>';
					echo '<td><strong>'.$m++.'</strong></td>';
					echo '<td><strong>'.$chit[$k]['macv'].'</strong></td>';
					echo '<td><strong>'.$chit[$k]['tencv'].'</strong></td>';
					echo '<td><strong>'.$chit[$k]['donvi'].'</strong></td>';
					echo '<td>'.$chit[$k]['khoiluong'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '</tr>';
				$homecontroller1=new HomeController();
				$sanpham1[] = array();
				$sanpham1[]=$homecontroller->GetVT_MaCV($chit[$k]['macv']);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
					if(substr($sp1[$i]['mavt'],0,1)=="N")$demnv++;
					if(substr($sp1[$i]['mavt'],0,1)=="V")$demvl++;
					if(substr($sp1[$i]['mavt'],0,1)=="M")$demmay++;
					}
					}
				if($demnv > 0)
				{
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Nhân Công</strong></em></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '</tr>';
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="N")
					{
					echo '<tr>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi']*$chit[$k]['khoiluong'].'</td>';
					echo '<td></td>';
					echo '</tr>';
					}
					}
				}}
				if($demvl > 0)
				{
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Vật liệu</strong></em></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '</tr>';
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="V")
					{
					echo '<tr>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi']*$chit[$k]['khoiluong'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '</tr>';
					}
					}
				}}
				if($demmay >0)
				{
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Máy thi Công</strong></em></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '</tr>';
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="M")
					{
					echo '<tr>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td>'.$sp1[$i]['haophi']*$chit[$k]['khoiluong'].'</td>';
					echo '</tr>';
					}
					}
				}
				}
				unset($sanpham1);
				
				
					}
				}unset($cthm);?></table><?php
					
				}
		}
		?> 
    </div>
                <div>
                <?php if(isset($_SESSION['cart_products'])|| $dem1>0)
				echo "<a href='home1.php'><span class='glyphicon  glyphicon-arrow-left'></span>Quay lại công trình</a>";
				}} }?>
                </div>
    </div>
 </div>
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

