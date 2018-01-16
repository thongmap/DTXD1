<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
require_once  ('../controllers/home_controller.php');

//add product to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	foreach($_POST as $key => $value1){ //add all post vars to new_product array
		$new_product1[$key] = filter_var($value1, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product1['type']);
 	//we need to get product name and price from database.
    $homecontroller=new HomeController();
	$sanpham[]=$homecontroller->GetCV_MaCV($_POST['macv']);
	foreach($sanpham as $sp){
		//fetch product name, price from db and add to new_product array
        $new_product["tencv"] = $sp[0]['tencv']; 
        $new_product["donvi"] = $sp[0]['donvi'];
		$new_product["khoiluong"] = 0;
        $new_product["giavl"] = $sp[0]['giavl'];
        $new_product["gianc"] = $sp[0]['gianc'];
        $new_product["giamay"] = $sp[0]['giamay'];				
		
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['macv']])) //check item exist in products array
           	{
                unset($_SESSION["cart_products"][$new_product['macv']]); //unset old array item
            }    
			
        }
        $_SESSION["cart_products"][$new_product['macv']] = $new_product; //update or create product session with new item  
    } 
	$homecontroller1=new HomeController();
	$sanpham1[]=$homecontroller->GetVT_MaCV($_POST['macv']);
	foreach($sanpham1 as $sp1){
		for($i=0; $i<count($sp1); $i++)
		{
		//fetch product name, price from db and add to new_product array
		$new_product1["mavt"] = $sp1[$i]['mavt']; 
        $new_product1["tenvt"] = $sp1[$i]['tenvt']; 
        $new_product1["donvi"] = $sp1[$i]['donvi'];
        $new_product1["haophi"] = $sp1[$i]['haophi'];
        $new_product1["dongia"] = $sp1[$i]['dongia'];
        if(isset($_SESSION["cart_products1"])){  //if session var already exist
            if(isset($_SESSION["cart_products1"][$new_product1['mavt']])) //check item exist in products array
           	{
                unset($_SESSION["cart_products1"][$new_product1['mavt']]); //unset old array item
            }    
			
        }
        $_SESSION["cart_products1"][$new_product1['mavt']] = $new_product1; //update or create product session with new item  \
		}
    } 
}


//update or remove items 
if(isset($_POST["kluong"]))
{
	//update item quantity in product session
	if(isset($_POST["kluong"]) && is_array($_POST["kluong"])){
		foreach($_POST["kluong"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["khoiluong"] = $value;
			}
		}
	}
	//remove an item from product session
	
}

if(isset($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}	
		
}
if(isset($_POST['details']))
{
	unset($_SESSION['Chitiet']);
	$_SESSION['Chitiet'] = $_POST['details'];
}
if(isset($_POST['Hangmuccode']))
{
	unset($_SESSION["cart_products"]);
	$homecontroller2=new HomeController();
	$sanpham1[]=$homecontroller2->GetCTHM_MaHM($_POST['Hangmuccode']);
	foreach($sanpham1 as $sp1){
		for($i=0; $i<count($sp1); $i++)
		{
		$_SESSION['TenHM']=$sp1[$i]['tenhm'];
		//fetch product name, price from db and add to new_product array
		$new_product1["macv"] = $sp1[$i]['macv']; 
        $new_product1["tencv"] = $sp1[$i]['tencv']; 
        $new_product1["donvi"] = $sp1[$i]['donvi'];
		$new_product1["khoiluong"]=$sp1[$i]['khoiluong'];
        $new_product1["giavl"] = $sp1[$i]['thanhtienvl'];
        $new_product1["gianc"] = $sp1[$i]['thanhtiennc'];
		$new_product1["giamay"] = $sp1[$i]['thanhtienm']; 	
        $_SESSION["cart_products"][$new_product1['macv']] = $new_product1; //update or create product session with new item  \
		}
    } 
}
if(isset($_POST["NewCV"]))
{
		$dem = 0;$a=array();
		$hocontrol = new HomeController();
		$hocontrol->ThemCongViec($_POST['macv'],$_POST['tencv'],$_POST['donvi']);
		$new_product1["macv"] = $_POST['macv']; 
        $new_product1["tencv"] = $_POST['tencv']; 
        $new_product1["donvi"] = $_POST['donvi'];
		$new_product1["khoiluong"]=0;
		if($_POST['nc'] != -1)
		{
			foreach($_POST['nc']as $i)
			{
				array_push($a,$i);
			}
			foreach($_POST['haophinc']as $j)
			{
			    $hocontrol->ThemHaoPhi($_POST['macv'],$a[$dem++],$j);
			}
		}
		
		//	$_SESSION["cart_products"][$new_product1['macv']] = $new_product1; //update or create product session with new item  \
}
header("location:home1.php");
?>