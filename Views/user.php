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
	i=1;"
;	}?>
	if(i ==0)
	window.location="logout.php";	
}function Check()
{
	return confirm('Bạn có muốn xóa công trình không ?');
	
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
					</li><li><a onClick="Checklogout();">Đăng xuất</a></li>				</ul>
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
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     
 <div class="main">
    <div class="content">
    	<div class="content_top">
    <div class="clear"></div>
   
		

    <div class="clear"></div>
          <div class="content_top">
    		<div class="heading">
    		<h3>Danh sách công trình đã lưu</h3>
    		</div>
            <form action="home1.php" method="post">
            <div class="add-cart"><button type="submit"><span class="glyphicon glyphicon-plus-sign"></span>Tạo công trình mới</button></div></form>
    		<div class="clear"></div>
    	</div>
				</div>
                <table class="table table-bordered table-list table-striped">
		<thead>
        <tr class="text-center">
        	<td width="3%"><strong>STT</strong></td>
            <td width="15%"><strong>MÃ CÔNG TRÌNH</strong></td>
            <td width="30%"><strong>TÊN CÔNG TRÌNH</strong></td>
            <td width="15%"><strong>TÊN NGƯỜI LẬP</strong></td>
            <td width="40%"><strong>TỔNG KINH PHÍ</strong></td>
            <td><strong>CHI TIẾT</strong></td>
            <td></td>
        </tr>
        </thead>
         <form method="post" id="detailsCT" name="detailsCT" action="detailCT.php">
		 <?php 
		 $j=1;
		 $homecontroller1=new HomeController();
		 $sanpham1[]=$homecontroller1->GetDT_mand($_SESSION['Mand']);
		foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
				{
					echo '<tr class="text-center" >';
					echo '<td style="padding:14px">'.$j++.'</td>';
					echo '<td style="padding:14px">'.$sp1[$i]['mact'].'</td>';
					echo '<td style="padding:14px">'.$sp1[$i]['tenct'].'</td>';
					echo '<td style="padding:14px">'.$_SESSION['Tennd'].'</td>';
					echo '<td style="text-align:right;padding:14px">'.chuyenso($sp1[$i]['tongcong']).' VND</td>';
					echo '<td><button type="submit" style="height:15px" id="detailsCongT" name="detailsCongT" value="'.$sp1[$i]['mact'].'"  class="btn btn-chitiet btn-link">Xem chi tiết</button></td>';
					echo '<td><button type="submit" onClick="return Check();" style="height:15px" id="delCongT" name="delCongT" value="'.$sp1[$i]['mact'].'"  class="btn btn-chitiet btn-link"><span class="glyphicon glyphicon-erase"></span></button></td>';
					echo '</tr>';
					}
									}
		?>  
		</form>	
    </table>
    
				</div>
                <div>
                <?php if(isset($_SESSION['cart_products']) || $dem >0)
				echo "<a href='home1.php'><span class='glyphicon  glyphicon-arrow-left'></span>Quay lại công trình</a>";
				?>
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
</body>
</html>

