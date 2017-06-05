<?php
class Stallioni_Shop_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$request = Mage::helper('core/url')->getCurrentUrl();
		$pathInfo = trim($request, '/');        
        $lastSegment = basename(parse_url($pathInfo, PHP_URL_PATH));
        if($lastSegment == "shop"){
			$this->norouteAction();
			return;
		}
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		$sqlQuery['vendor_url'] = $request;
		$vendor_id = $sqlQuery['vendor_id'];
		$vendorname = $sqlQuery['vendorname'];
		$vendorlogo = $sqlQuery['vendorlogo'];
		$description = $sqlQuery['description'];
		$address = $sqlQuery['address'];		
		Mage::register('vendordetails', $sqlQuery);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/vendorshop.phtml');
		// Render the template to the browser
		echo $block->toHtml(); 
    }
    public function aboutAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$request = Mage::helper('core/url')->getCurrentUrl();
		$postvalues = $this->getRequest()->getParams();
		$lastSegment = $postvalues['shop_name'];
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		Mage::register('vendordetails', $sqlQuery);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/about.phtml');
		echo $block->toHtml();        
    }
    public function contactAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$request = Mage::helper('core/url')->getCurrentUrl();
		$postvalues = $this->getRequest()->getParams();
		$lastSegment = $postvalues['shop_name'];
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		$sqlQuery['vendorurl'] = $request;
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		Mage::register('vendordetails', $sqlQuery);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/contact.phtml');
		echo $block->toHtml();  
	}
    public function howtoorderAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$request = Mage::helper('core/url')->getCurrentUrl();
		$postvalues = $this->getRequest()->getParams();
		$lastSegment = $postvalues['shop_name'];
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		$sqlQuery['vendorurl'] = $request;
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		Mage::register('vendordetails', $sqlQuery);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/howorder.phtml');
		echo $block->toHtml();  
	}
	public function pageAction(){
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$postvalues = $this->getRequest()->getParams();
		$lastSegment = $postvalues['shopset']['shopname'];
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		$sqlQuery['vendorurl'] = $request;
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		Mage::register('vendordetails', $sqlQuery);
		Mage::register('pagedetails',$postvalues);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/page.phtml');
		echo $block->toHtml(); 
	}
	public function capoptionsAction(){
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Shop'));
		$postvalues = $this->getRequest()->getParams();
		$lastSegment = $postvalues['shopset']['shopname'];
		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
		$sql = "Select * from vendorpage where vendorname='$lastSegment'";
		$sqlQuery = $read->fetchRow($sql);
		$sqlQuery['vendorurl'] = $request;
		if((!isset($sqlQuery))||(!($sqlQuery))){
			$this->norouteAction();
			return;
		}
		Mage::register('vendordetails', $sqlQuery);
		Mage::register('pagedetails',$postvalues);
		$block = $this->getLayout()->createBlock('core/template');
		$block->setTemplate('stallioni/shop/capoptions.phtml');
		echo $block->toHtml(); 
	}
	
}
