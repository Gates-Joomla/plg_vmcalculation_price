<?php
	
	
	namespace Vmcalculation_price;
	
	
	class Helper
	{
		
		/**
		 * Helper constructor.
		 * @since 3.9
		 */
		public function __construct ()
		{
		
		}
		
		public function recalculateForQuantity( $virtuemart_product_id , $quantity ,  &$calculationHelper , &$rules){
			
			$cloneBasePrice = $calculationHelper->productPrices['basePrice'] ;
			$calculationHelper->productPrices['basePrice'] = $cloneBasePrice * $quantity[0]  ;
			
			
			
		}
		
		
	}