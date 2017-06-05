<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Category controller
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author     Magento Core Team <core@magentocommerce.com>
 */
include_once 'Mage/Catalog/controllers/CategoryController.php';
class Stallioni_Shop_CategoryController extends Mage_Catalog_CategoryController
{

    /**
     * Initialize requested category object
     *
     * @return Mage_Catalog_Model_Category
     */
     
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
		Mage::register('pager',$pager);		
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
