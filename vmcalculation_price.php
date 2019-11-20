<?php

if (!defined('_JEXEC'))
die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 * Calculation plugin for quantity based price rules
 *
 * @version $Id:$
 * @package VirtueMart
 * @subpackage Plugins - avalara
 * @author Max Milbers
 * @copyright Copyright (C) 2012 - 2013 iStraxx - All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 *
 */

if (!class_exists('vmCalculationPlugin')) require(VMPATH_PLUGINLIBS.DS.'vmcalculationplugin.php');

defined('AVATAX_DEBUG') or define('AVATAX_DEBUG', 1);

function avadebug($string,$arg=NULL){
	if(AVATAX_DEBUG) vmdebug($string,$arg);
}

class plgVmCalculationVmcalculation_price extends vmCalculationPlugin {

	private $app ;
	
	

	function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
		JLoader::registerNamespace( 'Vmcalculation_price',JPATH_PLUGINS.'/vmcalculation/vmcalculation_price/classes',$reset=false,$prepend=false,$type='psr4');
		$this->app =  \JFactory::getApplication() ;
		
		
		
	}
	function plgVmOnAddToCart($Cart){
	
	}
	
	function plgVmOnAddToCartFilter ($product, $customfield, $customProductData, $customFiltered ){
 
	}
	
	
	
	protected function plgVmGetPluginInternalDataCalcList(&$calcData){
	
	}

	function plgVmOnStoreInstallPluginTable($jplugin_name,$name,$table=0) {
	
	}
	
	
	/**
	 *
	 * @param $calc
	 * @param $testedRules
	 * @since 3.9
	 */
	public function plgVmInGatherEffectRulesBill($calc , $testedRules){
	
	}

	/**
	 * We can only calculate it for the productdetails view
	 * @param $calculationHelper
	 * @param $rules
	 */
	public function plgVmInGatherEffectRulesProduct( &$calculationHelper,&$rules ){
		
		$VirtueMartCart = new VirtueMartCart();
		$cart                    = VirtueMartCart::getCart( false );
		
		$VirtueMartCart->storeCart($cart) ;
		
		$cart                    = VirtueMartCart::getCart( false );
		
		
		
		
//		 echo'<pre>';print_r( $cart );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );
		// $rules[1]['calc_value'] = 5555 ;
		//		echo'<pre>';print_r( $testedRules[1]);echo'</pre>'.__FILE__.' '.__LINE__;
		//		die(__FILE__ .' '. __LINE__ );
		
		$task = $this->app->input->get('task' , false , 'STRING') ;
		$view = $this->app->input->get('view' , false , 'STRING') ;
		$quantity = $this->app->input->get('quantity' , [] , 'ARRAY') ;
		$virtuemart_product_id = $this->app->input->get('virtuemart_product_id' , [] , 'ARRAY') ;
		
		
		$minicart_task = $this->app->input->get('minicart_task' , false , 'STRING') ;
		
		$customProductData = $this->app->input->get('customProductData' , [] , 'ARRAY') ;
		
		if( $task == 'recalculate' && $view == 'productdetails' )
		{
			$Helper = new \Vmcalculation_price\Helper();
			$Helper->recalculateForQuantity( $virtuemart_product_id , $quantity , $calculationHelper , $rules ) ;
//			echo'<pre>';print_r( $Helper );echo'</pre>'.__FILE__.' '.__LINE__;
		}#END IF
		
		/*return ;
		echo'<pre>';print_r( $task );echo'</pre>'.__FILE__.' '.__LINE__;
		echo'<pre>';print_r( $view );echo'</pre>'.__FILE__.' '.__LINE__;
		echo'<pre>';print_r( $customProductData );echo'</pre>'.__FILE__.' '.__LINE__;
		die(__FILE__ .' '. __LINE__ );
		
		if( $minicart_task )
		{
			$task = $minicart_task ;
		}#END IF
		
//		echo'<pre>';print_r( $calculationHelper->_cart->cartProductsData );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );
		
		
		$arrTask = ['recalculate' ,'refresh' ];
		if(  !in_array( $task , $arrTask) )
		{
			return ;
		}#END IF
		$Data = reset($customProductData);
		
		
		
		if( !isset($Data[33]) )
		{
			return ;
		}#END IF
		
		$virtuemart_custom_id = array_key_first($Data) ;
		$virtuemart_customfield_id =  $Data[$virtuemart_custom_id]  ;
		
		
		$db = JFactory::getDbo();
		$query = $db->getQuery( true );
		$query->select('*')
			->from($db->quoteName('#__virtuemart_product_customfields'));
		
		$where[] =  $db->quoteName('virtuemart_custom_id') . '=' . $db->quote($virtuemart_custom_id);
		$where[] =  $db->quoteName('virtuemart_customfield_id') . '=' . $db->quote($virtuemart_customfield_id);
		
		$query->where($where) ;
		
		$db->setQuery($query);
		$res = $db->loadObject();
		
		$calculationHelper->productPrices['basePrice'] = $res->customfield_price  ;
		
		*/
//		echo'<pre>';print_r( $res->customfield_price );echo'</pre>'.__FILE__.' '.__LINE__;
//		echo'<pre>';print_r( $Data );echo'</pre>'.__FILE__.' '.__LINE__;
//		echo'<pre>';print_r( $view );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );
//		$calculationHelper->productPrices['product_price'] = 111 ;
//		$calculationHelper->productPrices['costPrice'] = 222 ;
//
//		$calculationHelper->productPrices['basePriceVariant'] = 444;
		
//		echo'<pre>';print_r( $calculationHelper->productPrices );echo'</pre>'.__FILE__.' '.__LINE__;
//		echo'<pre>';print_r( $rules );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );
	}

 

	
	
	
	
	
	
	
	public function plgVmGetPluginInternalDataCalc(&$calcData){
		die(__FILE__ .' '. __LINE__ );
		
		return TRUE;
	}

	public function plgVmDeleteCalculationRow($id){
		die(__FILE__ .' '. __LINE__ );
	
	}
 

	public function plgVmInterpreteMathOp ($calculationHelper, $rule, $price,$revert){
        die(__FILE__ .' '. __LINE__ );
	}

	function plgVmConfirmedOrder ($cart, $order) {
		die(__FILE__ .' '. __LINE__ );
		

	}

	

	public function plgVmOnUpdateOrderPayment($data,$old_order_status){
        die(__FILE__ .' '. __LINE__ );
	}

	
 
 
	
	
	
	
}

// No closing tag
