<?php
class BuyableNumberSoldDecorator extends DataObjectDecorator {
	
	function extraStatics(){
		return array(
			'db' => array(
				'NumberSold' => 'Int'
			)
		);
	}
	
	public static $is_popular_min = 2;
	
	function updateSummaryFields(Fieldset &$fields) {
        $fields['TotalNumberSold'] = 'Number Sold';
    }

	public function TotalNumberSold(){
		$num = $this->owner->NumberSold;
		return $num;
	}
	
	public function getIsPopular(){
		if($this->TotalNumberSold() >= self::$is_popular_min ){
			return true;
		}
	}
	
}
