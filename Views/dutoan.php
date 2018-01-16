<?php
session_start();
function chuyenso($i)
{
	echo number_format($i,0,'.','.');
}
require_once  ('../controllers/home_controller.php');
$tongcong=0;
$homecontroller = new HomeController();
if(!isset($_SESSION['Quyen']) || $_SESSION['Quyen']==1)
{
	header("location:login.php");
}
if(isset($_POST['dutoan']))
{
	if(count($_SESSION["cart_products"])==1)
	{
		$mact=$homecontroller->ThemHangMuc($_POST['tenhm'],$_POST['tongvl'],$_POST['tongnc'],$_POST['tongmay'],$_SESSION['Mand']);
		$homecontroller->ThemCTHangMuc($mact,$_POST['dtmacv'],$_POST['khoiluong'],$_POST['vl'],$_POST['nc'],$_POST['may']);
	}
	else
	{
		$mact=$homecontroller->ThemHangMuc($_POST['tenhm'],$_POST['tongvl'],$_POST['tongnc'],$_POST['tongmay'],$_SESSION['Mand']);
		$khoiluong =explode(',',$_POST['khoiluong']);
		$macv=explode(',',$_POST['dtmacv']); 
		$may=explode(',',$_POST['may']);	
		$nc=explode(',',$_POST['nc']);	
		$vl=explode(',',$_POST['vl']);					
		for($i=0;$i<count($macv);$i++){echo $i;
			$homecontroller->ThemCTHangMuc($mact,$macv[$i],$khoiluong[$i],$vl[$i],$nc[$i],$may[$i]);
			}
	}	
	$_SESSION['tongcongall'] += $_SESSION['tongvl'] + $_SESSION['tongnc']+$_SESSION['tongmay'];
	unset($_SESSION['cart_products']);
	header("location:home1.php");
}
if(isset($_POST['congtrinh']))
{
	if(isset($_SESSION['cart_products']))
	{if(count($_SESSION["cart_products"])==1)
	{
		$mact=$homecontroller->ThemHangMuc($_POST['tenhm1'],$_SESSION['tongvl'],$_SESSION['tongnc'],$_SESSION['tongmay'],$_SESSION['Mand']);
		$homecontroller->ThemCTHangMuc($mact,$_POST['ctmacv'],$_POST['khoiluong'],$_POST['vl'],$_POST['nc'],$_POST['may']);
	}
	else
	{
		$mact=$homecontroller->ThemHangMuc($_POST['tenhm1'],$_SESSION['tongvl'],$_SESSION['tongnc'],$_SESSION['tongmay'],$_SESSION['Mand']);
		$khoiluong =explode(',',$_POST['khoiluong']);
		$macv=explode(',',$_POST['ctmacv']); 
		$may=explode(',',$_POST['may']);	
		$nc=explode(',',$_POST['nc']);	
		$vl=explode(',',$_POST['vl']);					
		for($i=0;$i<count($macv);$i++)
			$homecontroller->ThemCTHangMuc($mact,$macv[$i],$khoiluong[$i],$vl[$i],$nc[$i],$may[$i]);
	}
	}
	$_SESSION['tongcongall'] += $_SESSION['tongvl'] + $_SESSION['tongnc']+$_SESSION['tongmay'];
	unset($_SESSION['cart_products']);
	$macongtrinh = $homecontroller->ThemCT($_SESSION['Mand'],$_SESSION['tongcongall'],$_POST['tenct']);
	$homecontroller->ThemChiTietCT($macongtrinh);
	$_SESSION['tongcongall']=0;
	header("location:user.php");
}
if(isset($_POST['AddHM']))
{
unset($_SESSION['cart_products']);
header("location:home1.php");
}
?>