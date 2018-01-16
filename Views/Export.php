<?php
session_start();
function chuyenso($i)
{
	return number_format($i,0,'.','.');
}
require_once  ('../controllers/home_controller.php');
require_once '../Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:A2')
->mergeCells('B1:B2')
->mergeCells('C1:C2')
->mergeCells('D1:D2')
->mergeCells('E1:E2')
->mergeCells('F1:H1')
->mergeCells('I1:K1');
$objPHPExcel->getActiveSheet()->setTitle("Dự Toán");
$homecontroller = new HomeController();
$tongcongvl = 0;
$tongcongnc = 0;
$tongcongmay = 0;
        $objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Mã hiệu công tác')
			->setCellValue('C1', 'Danh mục công tác')
			->setCellValue('D1', 'Đơn vị')
			->setCellValue('E1', 'Khối lượng')
			->setCellValue('F1','Đơn giá')
			->setCellValue('F2', 'Vật liệu')
			->setCellValue('G2', 'Nhân Công')
			->setCellValue('H2', 'Máy Thi Công')
			->setCellValue('I1','Thành tiền')
			->setCellValue('I2', 'Vật liệu')
			->setCellValue('J2', 'Nhân Công')
			->setCellValue('K2', 'Máy Thi Công');
		 	if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$i=1;$j=3;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{
					 $objPHPExcel->setActiveSheetIndex(0)			
				      ->setCellValue('A'.$j,$i++ )
					  ->setCellValue('B'.$j, $cart_itm['macv'])
					  ->setCellValue('C'.$j, $cart_itm['tencv'])
					  ->setCellValue('D'.$j, $cart_itm['donvi'])
					  ->setCellValue('E'.$j, $cart_itm['khoiluong'])
					  ->setCellValue('F'.$j, $cart_itm['giavl'])
					  ->setCellValue('G'.$j, $cart_itm['gianc'])
					  ->setCellValue('H'.$j, $cart_itm['giamay']);
					if($cart_itm["khoiluong"] >0)
					{
					$giavl=$cart_itm["giavl"] * $cart_itm["khoiluong"];
					$gianc=$cart_itm["gianc"] * $cart_itm["khoiluong"];
					$giamay=$cart_itm["giamay"] * $cart_itm["khoiluong"];
					$tongcongvl=$tongcongvl+$giavl;
					$tongcongnc+=$gianc;
					$tongcongmay+=$giamay;
					$objPHPExcel->setActiveSheetIndex(0)	
						->setCellValue('I'.$j, $giavl)
					  	->setCellValue('J'.$j, $gianc)
					  	->setCellValue('K'.$j++, $giamay);
					}
					else
					{
						$objPHPExcel->setActiveSheetIndex(0)	
							->setCellValue('I'.$j, "")
					  		->setCellValue('J'.$j, "")
					  		->setCellValue('K'.$j++, "");
					}
				}	
				$objPHPExcel->setActiveSheetIndex(0)	
					->setCellValue('H'.$j, "Tổng Cộng")
					->setCellValue('I'.$j, $tongcongvl)
					->setCellValue('J'.$j, $tongcongnc)
					->setCellValue('K'.$j, $tongcongmay);		
			}
		$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A1:A2')
->mergeCells('B1:B2')
->mergeCells('C1:C2')
->mergeCells('D1:D2')
->mergeCells('E1:E2')
->mergeCells('F1:H1')
->mergeCells('I1:K1');
$objPHPExcel->getActiveSheet()->setTitle("Hao Phí");
   $objPHPExcel->setActiveSheetIndex(1)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Mã hiệu ')
			->setCellValue('C1', 'Tên công tác')
			->setCellValue('D1', 'Đơn vị')
			->setCellValue('E1', 'Khối lượng')
			->setCellValue('F1','Mức hao phí')
			->setCellValue('F2', 'Vật liệu')
			->setCellValue('G2', 'Nhân Công')
			->setCellValue('H2', 'Máy Thi Công')
			->setCellValue('I1','Khối lượng hao phí')
			->setCellValue('I2', 'Vật liệu')
			->setCellValue('J2', 'Nhân Công')
			->setCellValue('K2', 'Máy Thi Công');
		
            if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$dem=1;$j=3;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{
					$demnv=0;$demvl=0;$demmay=0;
					 $objPHPExcel->setActiveSheetIndex(1)			
				      ->setCellValue('A'.$j, $dem++ )
					  ->setCellValue('B'.$j, $cart_itm['macv'])
					  ->setCellValue('C'.$j, $cart_itm['tencv'])
					  ->setCellValue('D'.$j, $cart_itm['donvi'])
					  ->setCellValue('E'.$j++, $cart_itm['khoiluong']);
					$sanpham1[] = array();
					$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
					foreach($sanpham1 as $sp1){
					for($i=0; $i<count($sp1); $i++)
					{ 
					if(substr($sp1[$i]['mavt'],0,1)=="N")$demnv++;
					if(substr($sp1[$i]['mavt'],0,1)=="V")$demvl++;
					if(substr($sp1[$i]['mavt'],0,1)=="M")$demmay++;
					}}
				if($demnv > 0)
				{
					  $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$j.':C'.$j)->applyFromArray($style);
					$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B'.$j.':C'.$j)
				->setCellValue('B'.$j++, "Nhân Công");
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="N")
					{
						$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('B'.$j, $sp1[$i]['mavt'])
				->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('G'.$j,$sp1[$i]['haophi']);
					if($cart_itm["khoiluong"]>0)$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$j++,$sp1[$i]['haophi']*$cart_itm["khoiluong"]);
					else $j++;
					}
					}
				}}
				if($demvl > 0)
				{
					 $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$j.':C'.$j)->applyFromArray($style);
					$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B'.$j.':C'.$j)
				->setCellValue('B'.$j++, "Vật liệu");
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="V")
					{
						$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('B'.$j, $sp1[$i]['mavt'])
				->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('F'.$j,$sp1[$i]['haophi']);
					if($cart_itm["khoiluong"]>0)$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$j++,$sp1[$i]['haophi']*$cart_itm["khoiluong"]);
					else $j++;
					}
					}
				}}
				if($demmay > 0)
				{
					 $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$j.':C'.$j)->applyFromArray($style);
					$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B'.$j.':C'.$j)
				->setCellValue('B'.$j++, "Máy thi công");
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{
					if(substr($sp1[$i]['mavt'],0,1)=="M")
					{
						$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('B'.$j, $sp1[$i]['mavt'])
				->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('H'.$j,$sp1[$i]['haophi']);
					if($cart_itm["khoiluong"]>0)$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'.$j++,$sp1[$i]['haophi']*$cart_itm["khoiluong"]);
					else $j++;
					}
					}
				}}
				unset($sanpham1);
				}
			
			}
   
			$objPHPExcel->createSheet(2);
			
		   $objPHPExcel->setActiveSheetIndex(2)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Mã vật liệu ')
			->setCellValue('C1', 'Tên vật liệu')
			->setCellValue('D1', 'Đơn vị')
			->setCellValue('E1', 'Khối lượng')
			->setCellValue('F1', 'Đơn giá')
			->setCellValue('G1', 'Giá thông báo');
			$objPHPExcel->getActiveSheet()->setTitle("Nhân Công");
			$kiemtra[] = array();$klhaophi[]=array();
		 		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$j=2;$m=1;
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
					$objPHPExcel->setActiveSheetIndex(2)
					->setCellValue('A'.$j,$m)
					->setCellValue('B'.$j, $sp1[$i]['mavt'])
					->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('E'.$j,$klhaophi[$m++])
					->setCellValue('F'.$j,$sp1[$i]['dongia'])
					->setCellValue('G'.$j++,$sp1[$i]['dongia']);
					}}
				}
				unset($sanpham1);
				}
			}
		$objPHPExcel->createSheet(3);
		   $objPHPExcel->setActiveSheetIndex(3)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Mã vật liệu ')
			->setCellValue('C1', 'Tên vật liệu')
			->setCellValue('D1', 'Đơn vị')
			->setCellValue('E1', 'Khối lượng')
			->setCellValue('F1', 'Đơn giá')
			->setCellValue('G1', 'Giá thông báo');
			$objPHPExcel->getActiveSheet()->setTitle("Vật Liệu");
			unset($kiemtra);
			$kiemtra[] = array();$klhaophi1[]=array();
		 		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$j=2;$m=1;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						if(substr($sp1[$i]['mavt'],0,1)=="V" && array_search($sp1[$i]['mavt'],$kiemtra) == false) 
						array_push($kiemtra,$sp1[$i]['mavt']);
					}
				}
				unset($sanpham1);
				}
				for($k = 0;$k<count($kiemtra);$k++)
				{
					array_push($klhaophi1,0);
					foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
					echo $sp1[$i]['mavt']." ".$kiemtra[$k];
						if($sp1[$i]['mavt'] == $kiemtra[$k]) 
						$klhaophi1[$k]+= $sp1[$i]['haophi']*$cart_itm["khoiluong"];
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
					if(substr($sp1[$i]['mavt'],0,1)=="V" && array_search($sp1[$i]['mavt'],$kiemtra) == false )
						{
							array_push($kiemtra,$sp1[$i]['mavt']);
					$objPHPExcel->setActiveSheetIndex(3)
					->setCellValue('A'.$j,$m)
					->setCellValue('B'.$j, $sp1[$i]['mavt'])
					->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('E'.$j,$klhaophi1[$m++])
					->setCellValue('F'.$j,$sp1[$i]['dongia'])
					->setCellValue('G'.$j++,$sp1[$i]['dongia']);
					}}
				}
				unset($sanpham1);
				}
			}
		$objPHPExcel->createSheet(4);
			
		   $objPHPExcel->setActiveSheetIndex(4)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Mã vật liệu ')
			->setCellValue('C1', 'Tên vật liệu')
			->setCellValue('D1', 'Đơn vị')
			->setCellValue('E1', 'Đơn giá')
			->setCellValue('F1', 'Giá thông báo');
			$objPHPExcel->getActiveSheet()->setTitle("Máy Thi Công");
			unset($kiemtra);
			$kiemtra[] = array();$klhaophi2[]= array();
		 		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$j=2;$m=1;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						if(substr($sp1[$i]['mavt'],0,1)=="M" && array_search($sp1[$i]['mavt'],$kiemtra) == false) 
						array_push($kiemtra,$sp1[$i]['mavt']);
					}
				}
				unset($sanpham1);
				}
				for($k = 0;$k<count($kiemtra);$k++)
				{
					array_push($klhaophi1,0);
					foreach ($_SESSION["cart_products"] as $cart_itm)
				{	

					$homecontroller1=new HomeController();
				
				$sanpham1[]=$homecontroller->GetVT_MaCV($cart_itm["macv"]);
				foreach($sanpham1 as $sp1){
				for($i=0; $i<count($sp1); $i++)
					{ 
						if($sp1[$i]['mavt'] == $kiemtra[$k]) 
						$klhaophi2[$k]+= $sp1[$i]['haophi']*$cart_itm["khoiluong"];
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
					if(substr($sp1[$i]['mavt'],0,1)=="M" && array_search($sp1[$i]['mavt'],$kiemtra) == false )
						{
							array_push($kiemtra,$sp1[$i]['mavt']);
					$objPHPExcel->setActiveSheetIndex(4)
					->setCellValue('A'.$j,$m)
					->setCellValue('B'.$j, $sp1[$i]['mavt'])
					->setCellValue('C'.$j,$sp1[$i]['tenvt'])
					->setCellValue('D'.$j,$sp1[$i]['donvi'])
					->setCellValue('E'.$j,$klhaophi2[$m++])
					->setCellValue('F'.$j,$sp1[$i]['dongia'])
					->setCellValue('G'.$j++,$sp1[$i]['dongia']);
					}}
				}
				unset($sanpham1);
				}
			}
			$tongtt=0;
			$tong=0;
			$tongtl =0;
			$gtt=0;
			$GTGT=0;
			$objPHPExcel->createSheet(5);
			
		   $objPHPExcel->setActiveSheetIndex(5)
			->setCellValue('A1', 'STT')
			->setCellValue('B1', 'Khỏan mục chi phí')
			->setCellValue('C1', 'Ký hiệu')
			->setCellValue('D1', 'Cách tính')
			->setCellValue('E1', 'Thành tiền')
			->setCellValue('A2', 'I')
			->setCellValue('A3','1')
			->setCellValue('A4','2')
			->setCellValue('A5','3')
			->setCellValue('A6','4')
			->setCellValue('A8','II')
			->setCellValue('A9','III')
			->setCellValue('A11','IV')
			->setCellValue('A13','V')
			->setCellValue('B2', 'CHI PHÍ TRỰC TIẾP')
			->setCellValue('B3', 'Chi phí vật liệu')
			->setCellValue('B4', 'Chi phí nhân công')
			->setCellValue('B5', 'Chi phí máy thi công')
			->setCellValue('B6', 'Trực tiếp khác')
			->setCellValue('B7', 'Cộng chi phí trực tiếp')
			->setCellValue('B8', 'CHI PHÍ CHUNG')
			->setCellValue('B9', 'TỶ LỆ THUẾ TÍNH TRƯỚC')
			->setCellValue('B10', 'Chí phí xây dựng trước thuế')
			->setCellValue('B11', 'THUẾ GIÁ TRỊ GIA TĂNG')
			->setCellValue('B12', 'Chi phí xây dựng sau thuế')
			->setCellValue('B13', 'CHI PHÍ LÁN TRẠI, NHÀ TẠM')
			->setCellValue('B14', 'Tổng cộng')
			->setCellValue('C3', 'VL')
			->setCellValue('C4', 'NC')
			->setCellValue('C5', 'M')
			->setCellValue('C6', 'TT')
			->setCellValue('C7', 'T')
			->setCellValue('C8', 'C')
			->setCellValue('C9', 'TL')
			->setCellValue('C10', 'Gtt')
			->setCellValue('C11', 'GTGT')
			->setCellValue('C12', 'Gst')
			->setCellValue('C13', 'Gxdnt')
			->setCellValue('C14', 'Gxd')
			->setCellValue('E3', $tongcongvl)
			->setCellValue('E4', $tongcongnc)
			->setCellValue('E5', $tongcongmay)
			->setCellValue('E6', $tongtt = ($tongcongvl+$tongcongnc+$tongcongmay)*0.015)
			->setCellValue('E7', $tong= $tongcongvl+$tongcongnc+$tongcongmay+$tongtt)
			->setCellValue('E8', $tong * 0.05)
			->setCellValue('E9', $tongtl=($tong + $tong * 0.05)*0.055)
			->setCellValue('E10', $gtt=$tong * 0.05+$tongtl +$tong)
			->setCellValue('E11', $GTGT= $gtt*0.1)
			->setCellValue('E12', $gtt + $GTGT)
			->setCellValue('E13', $gtt * (1 + 0.1) * 0.01)
			->setCellValue('E14', $gtt + $GTGT +$gtt * (1 + 0.1) * 0.01)
			->setCellValue('D3', 'hsvl')
			->setCellValue('D4', 'hsnc')
			->setCellValue('D5', 'hsm')
			->setCellValue('D6', '(VL + NC + M)x1.5%')
			->setCellValue('D7', 'VL + NC + M + TT')
			->setCellValue('D8', 'T x 5%')
			->setCellValue('D9', '(T + C)x5,5%')
			->setCellValue('D10', 'T + C + TL')
			->setCellValue('D11', 'Gtt x 10%')
			->setCellValue('D12', 'Gtt + GTGT')
			->setCellValue('D13', 'Gtt x (1 + 10%) x 1%')
			->setCellValue('D14', 'Gst + Gxdnt');
			$objPHPExcel->getActiveSheet()->setTitle("Chi Phí Hạng Mục");
			
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$full_path = 'Exportexcel.xlsx';
$objWriter->save($full_path);
header("location:home1.php");
?>
</body>
</html>

