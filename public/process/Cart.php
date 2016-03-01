<?php
if(!isset($_SESSION))
session_start();

class CartItem{

	var $id;
	var $quantity;

	public function __construct(){
		$id=-1;
		$quantity=0;
	}

	public function setId(int $id)
	{
		$this->id=$id;
	}

	public function setQuantity(int $quantity)
	{
		$this->quantity=$quantity;
	}

}

class Cart{
		var $listCart;
		public function __construct(){
			$listCart=array();
		}

		public function	addItem(CartItem $item){
			array_push($listCart,$item);
		}

		public function	removeItem(int $index){
			unset($listCart[$index]);
		}

		public function	getItem(int $index){
			return ($listCart[$index]);
		}

		public function countItem(){
			return (count($listCart)>0)?count($listCart):"";
		}


}
?>