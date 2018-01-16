<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
require_once('../models/Connect.php');
$connect = new Connect();
if(!isset($_SESSION['Quyen'])||$_SESSION['Quyen']==2)
{
	header("location:login.php");
}
 ?>
<!DOCTYPE HTML>
<head>
<title>Dự Toán PhaTi</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../public/css/style.css">
<script type="text/javascript" src="../public/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../public/bootstrap/js/bootstrap.min.js"></script>
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
			    	<li class="active"><a href="Admin_danhmuc.php">Danh mục</a></li>
                    <li><a href="Admin_dongia.php">Đơn Giá</a></li>
                    <li ><a href="admin_user.php"  style="width:10em">Người dùng</a></li>
			    	
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box text-center">
	     		<form method="post" action="Admin_danhmuc.php">
                <span class="glyphicon glyphicon-search" style="padding:5px"></span>
	     			<input type="text" placeholder="Tìm kiếm" name="tim" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tìm kiếm';}"><input type="submit" value=""><input type="hidden" name="sx" value="1">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	  
  </div>
  
    <form name="import" method="post" enctype="multipart/form-data" class="pull-right">
    	<input type="file" name="file" value="Chọn File .xlsx" class="btn btn-default" /><br />
        <input type="submit" name="submit" value="Nhập Excel" class="btn btn-default pull-right"/>
        </form>
       <?php
	   require_once('../Classes/PHPExcel.php');
function convertXLStoCSV($infile,$outfile)
{
    $fileType = PHPExcel_IOFactory::identify($infile);
    $objReader = PHPExcel_IOFactory::createReader($fileType);
 
    $objReader->setReadDataOnly(true);   
    $objPHPExcel = $objReader->load($infile);    
 
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $objWriter->save($outfile);
}
$conn=$connect->Opendb();
$sql = false;
	    if(isset($_POST["submit"]))
{
	$file = $_FILES['file']['tmp_name'];
	convertXLStoCSV($file,'output.csv');
	$handle = fopen('output.csv', "r");
	$c = 0;
	$row =1;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		if($row ==1) {$row++;continue;}
		$id = $filesop[0];
		$name = $filesop[1];
		$donvi = $filesop[2];
		$vlc = $filesop[3];
		$vlp = $filesop[4];
		$nc = $filesop[5];
		$mtc = $filesop[6];
		$sql = sqlsrv_query($conn,"INSERT INTO CongViec(macv,tencv,donvi,giavl,gianc,giamay) VALUES ('$id','$name','$donvi','$vlc','$nc','$mtc')");
		$c +=1;
		if($c > 100)
		break;
	
}
		if($sql){
			echo "Thêm thành công";
		}else{
			echo "Đã có lỗi trong khi thêm";
		}
}

?>
<table class="table table-striped table-bordered table-list">
    <thead>
                    <tr>
                        <th rowspan="2"><center>STT</center></th>
                        <th rowspan="2">Mã hiệu công tác</th>
                        <th rowspan="2">Danh mục công tác</th>
                        <th rowspan="2">Đơn vị</th>
                        <th colspan="3"><center>Đơn giá</center></th
                        ></tr>
                        <tr>
                        <th><center>Vật liệu</center></th>
                        <th><center>Nhân Công</center></th>
                        <th>Máy</th>
                    </tr> 
      </thead>
                  <tbody>
                  <?php
				  $i =1;
				  $quyery ="Select * from CongViec";
				  if(isset($_POST['tim']))
				  $quyery.=" where tencv like '%".$_POST['tim']."%'";
				  $sql1= sqlsrv_query($conn,$quyery); 
				  if(count($sql1)>0)
				  {
 while (($rows = sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC))) {
	 ?>
                          <tr>
                           <td><?php echo $i++?></td>
                          	<td><?php echo $rows['macv']?></td>
                            <td><?php echo $rows['tencv']?></td>
                            <td><?php echo $rows['donvi']?></td>
                            <td><?php echo $rows['giavl']?></td>
                            <td><?php echo $rows['gianc']?></td>
                            <td><?php echo $rows['giamay']?></td>
                          </tr>
 <?php }}?>
                        </tbody>
                        </table>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <?php
	/**
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=codelution-export.xls");
 
// Add data table
include 'home.php';*/
?>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

