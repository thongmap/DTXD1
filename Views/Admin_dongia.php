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
if(!isset($_SESSION['Quyen']) || $_SESSION['Quyen']==2)
{
	header("location:login.php");
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
                    <li class="active"><a href="Admin_dongia.php">Đơn Giá</a></li>
                    <li ><a href="admin_user.php"  style="width:10em">Người dùng</a></li>
			    	
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box text-center">
	     		<form method="post" action="Admin_dongia.php">
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
	$c = 0;$vl = 0;$nc =0;$mtc = 0;
	$row =1;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		if($row ==1) {$row++;continue;}
		$id = $filesop[0];
		$name = $filesop[1];
		$donvi = $filesop[2];
		$dongia = $filesop[3];
		if(substr($id, 0, 1) === 'V' && $vl < 10)
		{
			$vl++;
			$sql = sqlsrv_query($conn,"INSERT INTO VatTu(mavt,tenvt,donvi,dongia) VALUES ('$id','$name','$donvi','$dongia')");
		}
		if(substr($id, 0, 1) === 'N' && $nc < 10)
		{
			$nc++;
			$sql = sqlsrv_query($conn,"INSERT INTO VatTu(mavt,tenvt,donvi,dongia) VALUES ('$id','$name','$donvi','$dongia')");
		}
		if(substr($id, 0, 1) === 'M' && $mtc < 10)
		{
			$mtc++;
			$sql = sqlsrv_query($conn,"INSERT INTO VatTu(mavt,tenvt,donvi,dongia) VALUES ('$id','$name','$donvi','$dongia')");
		}
		if($vl >= 10 &&  $nc >= 10 && $mtc >= 10)
		break;
	}
	
		if($sql){
			echo "Thêm thành công";
		}else{
			echo "Đã xảy ra lỗi trong khi thêm";
		}
}

?>
<table class="table table-striped table-bordered table-list">
    <thead>
                    <tr>
                        <th ><center>STT</center></th>
                        <th >Mã hiệu vật tư</th>
                        <th >Tên vật tự</th>
                        <th >Đơn vị</th>
                        <th ><center>Đơn giá</center></th>
      </thead>
                  <tbody>
                  <?php
				  $i =1;
				  $query ="Select * from VatTu";
				  if(isset($_POST['tim']))
				  $query.=" where tenvt like '%".$_POST['tim']."%'";
				  $sql1= sqlsrv_query($conn,$query); 
				  if(count($sql1)>0)
				  {
 while (($rows = sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC))) {
	 ?>
                          <tr>
                           <td><?php echo $i++?></td>
                          	<td><?php echo $rows['mavt']?></td>
                            <td><?php echo $rows['tenvt']?></td>
                            <td><?php echo $rows['donvi']?></td>
                            <td><?php echo $rows['dongia']?></td>
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
  
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

