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
 * @package     Mage_Customer
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Customer dashboard block
 *
 * @category   Mage
 * @package    Mage_Customer
 * @author      Magento Core Team <core@magentocommerce.com>
 */
 
 class Stallioni_Vendorpage_Block_Vendorsaves extends Mage_Core_Block_Template
{
	protected $_subscription = null;

    public function getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }
	public function getVendorsavesUrl()
    {
        return Mage::getUrl('vendorpage/vendorsave/');
    }
    //~ public function getCollection()
    //~ {
		//~ $postvalues = $this->getData();    	
    	//~ $resource = Mage::getSingleton('core/resource');
    	//~ $eavAttributeTable = $resource->getTable('stallioni/vendorpage');
    	//~ print_r($eavAttributeTable);
	//~ }

}
