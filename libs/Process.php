<?php
require_once __LIB_PATH."Cart.php";
require_once __LIB_PATH."Model.php";
if(!isset($_SESSION))
	session_start();
	
class Process{

    public function __construct(){//kết nối
		$this->model=new Model;
		if(!isset($_SESSION))
		session_start();
	}
	
	


public static function getNameUser(){
	
	if($_SESSION["isLogin"])
	{
	return $_SESSION["user"]["ten"];
	}
}

public static function getIdUser(){
	
	if($_SESSION["isLogin"])
	{
	return $_SESSION["user"]["user"];
	}
}

public static function logOut()
{
	$_SESSION["user"]=null;
	if (isset($_COOKIE['user'])) 
    unset($_COOKIE['user']);
    setcookie('user', '', time() - 3600, '/');
	$_SESSION["isLogin"]=false;
}

public static function addCartItem($id,$quantity=1){
	if(!isset($id))
		exit();
	$item=new CartItem;
	$item->id=$id;
	$item->quantity=$quantity;
	$item->active=true;
	$cart= self::getCart();
	$cart->addItem($item);
	$_SESSION["cart"]=serialize($cart);
}

public static function getCart(){
		
	if(!isset($_SESSION["cart"]))
	$_SESSION["cart"]=serialize(new Cart);
	
	$cart= unserialize($_SESSION["cart"]);
	return $cart;
}

public static function setCart($cart){
	
	$_SESSION["cart"]=serialize($cart);
}

}
?>