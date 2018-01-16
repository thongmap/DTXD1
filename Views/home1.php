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
$tongcongvl = 0;
$tongcongnc = 0;
$tongcongmay = 0;
if( !isset($_SESSION['Quyen']) ||$_SESSION['Quyen']==1)
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
<link rel="stylesheet" href="../public/css/flexselect.css" type="text/css" media="screen" />

<script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="../public/js/jquery.min.js"></script>
<script type="text/javascript" src="../public/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/js/liquidmetal.js" type="text/javascript"></script>
<script src="../public/js/jquery.flexselect.js" type="text/javascript"></script>
<script type="text/javascript" src="../public/js/move-top.js"></script>
<script type="text/javascript" src="../public/js/easing.js"></script>
<script type="text/javascript" src="../public/js/Checking.js"></script>
<script type="text/javascript">
function CodeHM()
{
	<?php if(isset($_SESSION['cart_products']))
	{
	echo "if( confirm('Bạn có muốn lưu hạng mục không ?')== true )
	return false;"
;	}?>
	if(document.getElementById('Hangmuccode').value == 0 )
	{
		alert("Xin chọn 1 hạng mục có sẵn");
		return false;
	}
	return true;
}
function Checklogout()
{
	var i=0;
	<?php
	$dem = 0;
	$checkhm[]=$homecontroller->GetHM_ND($_SESSION['Mand']);
	foreach($checkhm as $chm):
				for($j=0; $j<count($chm); $j++)
				{
				 	$dem++;
				}
				endforeach;
	 if(isset($_SESSION['cart_products']) || $dem >0)
	{
	echo "if( confirm('Bạn có muốn lưu lại công trình không ?')== true )
	i=1;"
;	}?>
	if(i ==0)
	window.location="logout.php";
	
}
function CheckInsert()
{
	var i=0;
	<?php
	 if(isset($_SESSION['cart_products']))
	{
	echo "if( confirm('Bạn có muốn lưu lại công trình không')== true )
	i=1;"
;	}?>
	if(i ==0)
	{
		return true;
	}
	return false;
	
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
					</li><li><a onClick="Checklogout();">Đăng xuất</a></li>
				</ul>
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
			    	<li class="active"><a href="home1.php">Công trình</a></li>
                    <li><a href="haophi.php">Hao Phí Vật Tư</a></li>
                    <li ><a href="vatlieu.php">Vật liệu</a></li>
                    <li ><a href="NC.php">Nhân Công</a></li>
                    <li ><a href="MTC.php">Máy thi Công</a></li>
			    	<li><a href="ChiphiHM.php">Chi phí hạng mục</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading ">
            <form action="dutoan.php" method="post">
            <table width="100%">
    		<tr>
            	<td class="text-uppercase"><h2>Tên Công Trình: <h2></td>
                <td> <input type="text" class="text-center" onKeyUp="ChangeName()" name="NameCT" id="TenCT" value="Công trình 1"  /></td>
            </tr>
            <tr height="10px"></tr>
            <tr>
            	<td class="text-uppercase"><h2>Tên Hạng Mục:</h2> </td>
                <td> <input type="text" class="text-center" id="NameHM" onKeyUp="ChangeName()" value="<?php if(isset($_SESSION['TenHM']))echo $_SESSION['TenHM'];else echo'Hạng Mục 1';?>"/></td>
            </tr>
            </table>
            <button type="submit" name="AddHM" id="AddHM" onClick="return CheckInsert();" ><span class="glyphicon glyphicon-plus-sign"></span> Thêm hạng mục </button>
    		</form>
            </div>
            <form action="dutoan.php" method="post">
            <input type="hidden" name="tenct" value="Công trình 1"  id="NameCT"/>
             <div class="add-cart"><button type="submit" name="congtrinh"><span class="glyphicon  glyphicon-save"></span>Lưu Công Trình</button></div>
              <input type="hidden" name="tenhm1" id="tenhm1" value="Hạng Mục 1"/>
           <?php 
							if(isset($_SESSION["cart_products"]))
							{
							if(count($_SESSION["cart_products"])!=1)
							{
								foreach ($_SESSION["cart_products"] as $cart_itm)
								{
									$ctmacv[]=$cart_itm["macv"];
									$giavl=$cart_itm["giavl"] * $cart_itm["khoiluong"];
									$gianc=$cart_itm["gianc"] * $cart_itm["khoiluong"];
									$giamay=$cart_itm["giamay"] * $cart_itm["khoiluong"];
									$vl[]=$giavl;
									$nc[]=$gianc;
									$may[]=$giamay;
									$khoiluong[] = $cart_itm["khoiluong"];
								}
							}
                            ?>
                            <!--<label>Thông tin khách hàng</label></span>-->
                            <input type="hidden" name="ctmacv" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $cart_itm["macv"];
							}
							else
							{
								for($i=0; $i<count($ctmacv); $i++)
								{
									echo $ctmacv[$i];
									echo ",";
								}
							}
							?>">							
                            
                            <input type="hidden" name="khoiluong" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $cart_itm["khoiluong"];
							}
							else
							{
								for($i=0; $i<count($khoiluong); $i++)
								{
									echo $khoiluong[$i];
									echo ",";
								}
							}
							?>">							
                            <input type="hidden" name="vl" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $giavl;
							}
							else
							{
								for($i=0; $i<count($vl); $i++)
								{
									echo $vl[$i];
									echo ",";
									
								}
							}
								?>">
                                <input type="hidden" name="nc" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $gianc;
							}
							else
							{
								for($i=0; $i<count($nc); $i++)
								{
									echo $nc[$i];
									echo ",";
									
								}
							}
								?>">
                                <input type="hidden" name="may" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $giamay;
							}
							else
							{
								for($i=0; $i<count($may); $i++)
								{
									echo $may[$i];
									echo ",";
									
								}
							}
								?>">
                                <?php }
								?>
             </form>
             <form action="updatecart.php" method="post">
    		<br><br><div class="pull-right"><label><h3>Chọn Hạng Mục: </h3></label> <select style="width:150px" name="Hangmuccode" id="Hangmuccode" class="Codehm"><option value="0" selected></option> <?php 
				$tenhm[]=$homecontroller->GetHM_ND($_SESSION['Mand']);
				foreach($tenhm as $hm):
				for($j=0; $j<count($hm); $j++)
				{
				 	echo "<option value='".$hm[$j]['mahm']."'>".$hm[$j]['tenhm']."</option>";
				}
				endforeach;
				?></select></div><br><br><br><br><div class="add-cart"><button type="submit" onClick="return CodeHM()" ><span class="glyphicon glyphicon-floppy-open"></span>Chọn</button></div>
                </form>
            <div class="clear"></div>
    	</div>
    <div class="clear"></div>
    <br><br>
    <div class="content_top">
    		<div class="heading">
    		<h3>Công việc</h3>
             <form name="formtim" method="post" action="updatecart.php">  
			<input type="hidden" name="type" value="add" />		
            <label>Nhập tên công việc: </label>				
          <select class="flexselect" style="width:700px;" name="macv" id="macv">
          <option></option>
        <?php 
				$tencv[]=$homecontroller->GetTen_MaCV();
				//print_r($tencv);
				//echo $tencv;
				foreach($tencv as $cv):
				for($j=0; $j<count($cv); $j++)
				{
				 	echo "<option value='".$cv[$j]['macv']."'>".$cv[$j]['macv']." - ".$cv[$j]['tencv']."</option>";
				}
				endforeach;
				?>
      </select>
      <script type="text/javascript">
		  jQuery(document).ready(function() {
		  	$("select.flexselect").flexselect();
		  });
		  </script>
      	<input  type="submit" name="submitchon" value="Chọn" onClick="return KiemTra();">
        <input  type="button" data-toggle="modal" data-target="#additem" value="Thêm công việc mới">
        
  
    </form></div>
    		<div class="clear"></div>
    	</div>
   <table class="table table-striped table-bordered table-list table-responsive" id="tableID">
    <thead>
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2"><center>Mã hiệu công tác</center></th>
                        <th rowspan="2"><center>Danh mục công tác</center></th>
                        <th rowspan="2"><center>Đơn vị</center></th>
                        <th rowspan="2"><center>Khối lượng</center></th>
                        <th colspan="3"><center>Đơn giá</center></th>
                        <th colspan="3"><center>Thành tiền</center></th>
                        <th rowspan="2"><center>Ghi chú</center></th>
                        </tr>
                        <tr>
                        <th><center>Vật liệu</center></th>
                        <th><center>Nhân Công</center></th>
                        <th><center>Máy</center></th>
                        <th><center>Vật liệu</center></th>
                        <th><center>Nhân Công</center></th>
                        <th><center>Máy</center></th>
                    </tr> 
      </thead>
      <tbody>
		 <form method="post" action="updatecart.php"> 
		 <?php 
		 	if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$i=1;$j=3;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{
					echo '<td>'.$i++.'</td>';
					echo '<td id="dtmacv">'.$cart_itm["macv"].'</td>';
					echo '<td>'.$cart_itm["tencv"].'</td>';
					echo '<td>'.$cart_itm["donvi"].'</td>';
					echo '<td><input class="text-right" type="text" size="5" name="kluong['.$cart_itm["macv"].']"" maxlength="15" value ="'.$cart_itm["khoiluong"].'" style="background-color:transparent;border:0px;"/></td>';
					echo '<td align="right" id="vl">'.chuyenso($cart_itm["giavl"]).'</td>';
					echo '<td align="right" id="nc">'.chuyenso($cart_itm["gianc"]).'</td>';
					echo '<td align="right" id="may">'.chuyenso($cart_itm["giamay"]).'</td>';
											
					if($cart_itm["khoiluong"] >0)
					{
					$giavl=$cart_itm["giavl"] * $cart_itm["khoiluong"];
					$gianc=$cart_itm["gianc"] * $cart_itm["khoiluong"];
					$giamay=$cart_itm["giamay"] * $cart_itm["khoiluong"];
					$tongcongvl=$tongcongvl+$giavl;
					$tongcongnc+=$gianc;
					$tongcongmay+=$giamay;
					echo '<td align="right">'.chuyenso($giavl).'</td>';
					echo '<td align="right">'.chuyenso($gianc).'</td>';
					echo '<td align="right">'.chuyenso($giamay).'</td>';	
					}
					else
					{
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
					}
					echo '<td class="text-center"><button class="glyphicon glyphicon-remove" type="submit" onClick="return Xoa();" name="remove_code[]" value="'.$cart_itm["macv"].'" ></button><br><button type="submit" name="details" value="'.$cart_itm["macv"].'" >Chi tiết</button></td>';
					echo '';
					echo '</tr>';
				}	
			}
		$_SESSION['tongvl'] =$tongcongvl;
		$_SESSION['tongnc'] =$tongcongnc;
		$_SESSION['tongmay'] =$tongcongmay;
		?>
        
        <tr height="10px;"></tr>
        <tr>
        <td colspan="8" align="right" class="text-uppercase" style="color:#1d70b8"><strong>Tổng tiền</strong></td>
        <td  align="right" style="color:#1d70b8"><strong><?php echo chuyenso($tongcongvl)?></strong></td>
        <td  align="right" style="color:#1d70b8"><strong><?php echo chuyenso($tongcongnc)?></strong></td>
        <td  align="right" style="color:#1d70b8"><strong><?php echo chuyenso($tongcongmay)?></strong></td>
        <td></td></tr>
        
    <tr><td colspan="12" align="right"><div class="add-cart"><button type="submit" ><span class="glyphicon glyphicon-edit"></span> Cập nhật </button></div></td>
                             </tr>   
			</tbody>	
    </table>
   
		</form>	
       <form method="post" action="dutoan.php">
       <input type="hidden" name="tenhm" id="tenhm" value="Hạng Mục 1"/>
           <?php 
							if(isset($_SESSION["cart_products"]))
							{
							if(count($_SESSION["cart_products"])!=1)
							{
								foreach ($_SESSION["cart_products"] as $cart_itm)
								{
									$dtmacv[]=$cart_itm["macv"];
									$giavl=$cart_itm["giavl"] * $cart_itm["khoiluong"];
									$gianc=$cart_itm["gianc"] * $cart_itm["khoiluong"];
									$giamay=$cart_itm["giamay"] * $cart_itm["khoiluong"];
									$vl[]=$giavl;
									$nc[]=$gianc;
									$may[]=$giamay;
									$khoiluong[] = $cart_itm["khoiluong"];
								}
							}
                            ?>
                            <!--<label>Thông tin khách hàng</label></span>-->
                            <input type="hidden" name="dtmacv" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $cart_itm["macv"];
							}
							else
							{
								for($i=0; $i<count($dtmacv); $i++)
								{
									echo $dtmacv[$i];
									echo ",";
								}
							}
							?>">							
                            
                            <input type="hidden" name="khoiluong" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $cart_itm["khoiluong"];
							}
							else
							{
								for($i=0; $i<count($khoiluong); $i++)
								{
									echo $khoiluong[$i];
									echo ",";
								}
							}
							?>">							
                            <input type="hidden" name="vl" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $giavl;
							}
							else
							{
								for($i=0; $i<count($vl); $i++)
								{
									echo $vl[$i];
									echo ",";
									
								}
							}
								?>">
                                <input type="hidden" name="nc" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $gianc;
							}
							else
							{
								for($i=0; $i<count($nc); $i++)
								{
									echo $nc[$i];
									echo ",";
									
								}
							}
								?>">
                                <input type="hidden" name="may" value="<?php 
							if(count($_SESSION["cart_products"])==1)
							{
								echo $giamay;
							}
							else
							{
								for($i=0; $i<count($may); $i++)
								{
									echo $may[$i];
									echo ",";
									
								}
							}
								?>">
                                <?php }?>
								<input type="hidden" name="tongvl" value="<?php echo $tongcongvl;?>">
                                <input type="hidden" name="tongnc" value="<?php echo $tongcongnc;?>">                                                											                                <input type="hidden" name="tongmay" value="<?php echo $tongcongmay;?>">
                                <input type="hidden" name="tong" value="<?php echo $tongcongmay + $tongcongnc +$tongcongvl;?>">
           <div class="add-cart"><button type="submit" name="dutoan"><span class="glyphicon  glyphicon-save"></span>Lưu hạng mục</button></div>
           </form>
        <form method="post" action="Export.php">
   
				<div class="add-cart"><button name="Excel" type="submit"><span class="glyphicon  glyphicon-floppy-save"></span> Xuất Excel</button></div></div>
    </form>
    <table class="table table-bordered table-list table-striped">
		<thead>
                    <tr>
                        <th ><center>STT</center></th>
                        <th ><center>Mã hiệu</center></th>
                        <th ><center>Tên công tác</center></th>
                        <th ><center>Đơn vị</center></th>
                        <th ><center>Mức Hao Phí</center></th>
                        <th><center>Đơn giá</center></th>
                        </tr>
      </thead>
      <tbody>
		 <?php 
			if(isset($_SESSION["Chitiet"]))
			{
				$j=1;
					$demvl=0;$demnv =0;$demmay =0;
					$homecontroller1=new HomeController();
					$sanpham1[] = array();
					$sanpham1[]=$homecontroller->GetVT_MaCV($_SESSION["Chitiet"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
					if(substr($sp1[$i]['mavt'],0,1)=="N")$demnv++;
					if(substr($sp1[$i]['mavt'],0,1)=="V")$demvl++;
					if(substr($sp1[$i]['mavt'],0,1)=="M")$demmay++;
					}}
				if($demnv > 0)
				{
					$j=1;
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Nhân Công</strong></em></td>';
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
					echo '<td>'.$j++.'</td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td>'.$sp1[$i]['dongia'].'</td>';
					
					echo '</tr>';
					}
					}
				}}
				if($demvl > 0)
				{$j=1;
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Vật liệu</strong></em></td>';
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
					echo '<td>'.$j++.'</td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td>'.$sp1[$i]['dongia'].'</td>';
					
					echo '</tr>';
					}
					}
				}}
				if($demmay >0)
				{$j=1;
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td style="color:#0099FF"><em><strong>Máy thi Công</strong></em></td>';
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
					echo '<td>'.$j++.'</td>';
					echo '<td>'.$sp1[$i]['mavt'].'</td>';
					echo '<td>'.$sp1[$i]['tenvt'].'</td>';
					echo '<td>'.$sp1[$i]['donvi'].'</td>';
					echo '<td>'.$sp1[$i]['haophi'].'</td>';
					echo '<td>'.$sp1[$i]['dongia'].'</td>';
				
					echo '</tr>';
					}
					}
				}}
				unset($sanpham1);
				}
			unset($_SESSION['Chitiet']);
		?>  
		</form>
        </tbody>	
    </table>
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
    <div class="modal fade" id="additem" role="dialog">
    		<div class="modal-dialog">
      		<div class="modal-content">
        	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm Công việc mới</h4>
        </div>
        <div class="modal-body">
        <form action="updatecart.php" method="post">
        <table width="100%" id="tab" >
        	<tr><td>Mã công việc</td><td> <input type="text" id="macv"  style="width:200px" name="macv"></td></tr>
            <tr height="10px"></tr>
         	<tr><td>Tên công việc</td><td> <input type="text" id="tencv" name="tencv" style="width:200px"></td></tr>
          	<tr height="10px"></tr>
            <tr><td>Đơn vị</td><td> <select style="width:200px"  id="donvi" name="donvi">
			<?php
				 $donvi[]=$homecontroller->GetDonvi();
				 foreach($donvi as $dv):
				for($j=0; $j<count($dv); $j++)
				{
				 	echo "<option value='".$dv[$j]['donvi']."'>".$dv[$j]['donvi']."</option>";
				}
				endforeach;
	 ?></select></td></tr>
          	<tr height="10px"></tr>
            <tr><td>Vật tư</td><td id="vt"> <select id="nc[]" name="nc[]" style="width:200px"><option value="-1"></option><option class="text-uppercase" disabled><strong>Vật liệu</strong></option>
  						<?php 
				$vl[]=$homecontroller->GetVatLieu('V');
				foreach($vl as $nc):
				for($j=0; $j<count($nc); $j++)
				{
				 	echo "<option value='".$nc[$j]['mavt']."'>".$nc[$j]['tenvt']."</option>";
				}
				endforeach;
				?>
                <option class="text-uppercase" disabled><strong>Nhân Công</strong></option>
  						<?php 
				$vl1[]=$homecontroller->GetVatLieu('N');
				foreach($vl1 as $nc):
				for($j=0; $j<count($nc); $j++)
				{
				 	echo "<option value='".$nc[$j]['mavt']."'>".$nc[$j]['tenvt']."</option>";
				}
				endforeach;
				?>
                <option class="text-uppercase" disabled><strong>Máy Thi Công</strong></option>
  						<?php 
				$vl2[]=$homecontroller->GetVatLieu('M');
				foreach($vl2 as $nc):
				for($j=0; $j<count($nc); $j++)
				{
				 	echo "<option value='".$nc[$j]['mavt']."'>".$nc[$j]['tenvt']."</option>";
				}
				endforeach;
				?>
						</select></td><td> <input type="text" id="haophinc[]" name="haophinc[]" placeholder="Hao phí"></td><td><button type="button" class="btn btn-default " onclick="deleteRow(this)"><span class="glyphicon glyphicon-remove"></span></button></td></tr>
          	<tr height="10px"></tr>
                                    </table>
                       
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="addRow()">Thêm Vật tư</button>
        <button type="submit" name="NewCV" class="btn btn-default" value="OK">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
         </form>
      </div>
      </div>
      </div>
</body>
</html>

