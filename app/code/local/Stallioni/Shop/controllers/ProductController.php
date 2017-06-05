<?php
class Stallioni_Shop_ProductController extends Mage_Core_Controller_Front_Action
{
	public function prodsAction(){

        $postvalues = $this->getRequest()->getParams();
        //print_r($postvalues['shopset']);
        $shopname = $postvalues['shopset']['shopname'];
        $prodid = $postvalues['shopset']['prodid'];        
		//Load by ID (just load):
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$shopname'";
		$sqlQuery = $read->fetchRow($sql);
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		$sqlQuery['vendor_url'] = Mage::getBaseUrl().'shop/'.$shopname.'/';
		$vendor_id = $sqlQuery['vendor_id'];
		$vendorname = $sqlQuery['vendorname'];
		$vendorlogo = $sqlQuery['vendorlogo'];
		$address = $sqlQuery['address'];		
		Mage::register('vendordetails', $sqlQuery);
		Mage::register('vendorsingleproduct', $prodid);
		Mage::register('vendorname', $shopname);
		$block = $this->getLayout()->createBlock('core/template');
		$block1 = $this->getLayout()->createBlock('core/template');
		$block2 = $this->getLayout()->createBlock('core/template');
		$block3 = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/headerproduct.phtml');
		$block1->setTemplate('stallioni/shop/prodheader.phtml');
		$block2->setTemplate('stallioni/shop/product.phtml');
		$block3->setTemplate('stallioni/shop/prodfooter.phtml');
		echo $block->toHtml();
		echo $block1->toHtml();
		echo $block2->toHtml();  
		echo $block3->toHtml();  
	}
	public function catsAction(){
		$postvalues = $this->getRequest()->getParams();
		$shopname = $postvalues['shopset']['shopname'];
		$catid = $postvalues['shopset']['catid'];        
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$shopname'";
		$sqlQuery = $read->fetchRow($sql);
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		$pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
		$sqlQuery['vendor_url'] = Mage::getBaseUrl().'shop/'.$shopname.'/';
		$vendor_id = $sqlQuery['vendor_id'];
		$vendorname = $sqlQuery['vendorname'];
		$vendorlogo = $sqlQuery['vendorlogo'];
		$address = $sqlQuery['address'];
		Mage::register('vendordetails', $sqlQuery);
		Mage::register('vendorcategory', $catid);
		Mage::register('vendorname', $shopname);		
		$block = $this->getLayout()->createBlock('core/template');
		$block1 = $this->getLayout()->createBlock('core/template');
		$block2 = $this->getLayout()->createBlock('core/template');
		$block3 = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/headercategory.phtml');
		$block1->setTemplate('stallioni/shop/catheader.phtml');
		$block2->setTemplate('stallioni/shop/category.phtml');
		$block3->setTemplate('stallioni/shop/catfooter.phtml');
		echo $block->toHtml();
		echo $block1->toHtml();
		echo $block2->toHtml();  
		echo $block3->toHtml();  
	}
	public function compareaddAction(){		
		$postvalues = $this->getRequest()->getParams();
		$productId = $postvalues['prodids'];
		$product = Mage::getModel('catalog/product')
			->setStoreId(Mage::app()->getStore()->getId())
			->load($productId);
		if ($product->getId()) {
		Mage::getSingleton('catalog/product_compare_list')->addProduct($product);
		Mage::getSingleton('catalog/session')->addSuccess(
		$this->__('The product %s has been added to comparison list.', Mage::helper('core')->escapeHtml($product->getName()))
		);
		Mage::dispatchEvent('catalog_product_compare_add_product', array('product'=>$product));
		}
		Mage::helper('catalog/product_compare')->calculate();
		echo 'committed';
	}
}
