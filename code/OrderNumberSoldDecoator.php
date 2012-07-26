<?php
class OrderNumberSoldDecorator extends DataObjectDecorator{
	
	function extraStatics(){
		return array(
			'db' => array(
				'NumSoldDone' => 'Boolean'
			)
		);
	}
	
	function onBeforeWrite(){ 
      	if($this->owner->Status == 'Paid' && $this->owner->NumSoldDone == 0){
      		$this->owner->NumSoldDone = 1;
      		if($orderItems = $this->owner->Items()){
      			foreach ($orderItems as $orderItem){
	      			if($buyable = $orderItem->Buyable()){
	      				$oldNum = $buyable->NumberSold;
	      				$newNum = $oldNum + $orderItem->Quantity;
	      				$buyable->NumberSold = $newNum;
	      				$buyable->write();
	      				if($buyable->ProductID > 0){
	      					if($parent = DataObject::get_by_id("Product", $buyable->ProductID)){
	      						$parentOldNum = $parent->NumberSold;
	      						$parent->NumberSold = $parentOldNum + $newNum;
	      						$parent->write();
	      					}
	      				}
	      			}
      			}
      		}
      	}
      	parent::onBeforeWrite();
   	} 
}