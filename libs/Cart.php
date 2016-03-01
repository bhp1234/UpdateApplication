<?php
if(!isset($_SESSION))
session_start();

class CartItem{

	var $id;
	var $quantity;

	public function __construct(){
		$this->id=-1;
		$this->quantity=0;
		$this->active=true;
	}

	public function setId( $id)
	{
		$this->id=$id;
	}
	
	public function getId( )
	{
		return $this->id;
	}
	
	public function setQuantity( $quantity)
	{	if(empty($this->quantity))
			$this->quantity=0;

			$this->quantity+=$quantity;
	}
	
	public function getQuantity( )
	{
		return $this->quantity;
	}

}

class Cart{
		var $listCart;
		public function __construct(){
			$this->listCart=array();
		}

		public function	addItem( $item){
		
		 
		  if(!isset($this->listCart) || empty($this->listCart))
			$this->listCart=array();
			$kq=self::searchItem($item->id);
			if($kq>=0)
			{
			$this->listCart[$kq]->setQuantity($item->quantity);
			}
			else
			array_push($this->listCart,$item);
		}
		
		public function searchItem($id){
			for($i=0;$i<count($this->listCart);$i++)
			{
				if($this->listCart[$i]->id==$id)
				return $i;
			}
			return -1;
		}
		
		public function	removeItem( $index=-1,$id=""){
			if($index!=-1)
			array_splice($this->listCart,$index,1);
			if($id!="")
			{
				for($i=0;$i<count($this->listCart);$i++)
				{
					
					if( $this->listCart[$i]->id==$id)
					{
					array_splice($this->listCart,$i,1);
					return;
					}
				}
			}
		}

		public function	getItem( $index){
			return ($this->listCart[$index]);
		}

		public function countItem(){
			return (count($this->listCart)>0)?count($this->listCart):"";
		}

		public function reNew(){
			$this->listCart=array();
		}
		
		public function getTotalQuantity()
		{
		$total=0;
		foreach($this->listCart as $item)
		{
			$total+=$item->quantity;
		}
		return $total;
		}
}
?>