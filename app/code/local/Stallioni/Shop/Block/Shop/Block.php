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


class Stallioni_Shop_Block_Shop extends Mage_Core_Block_Template
{
	private $_itemPerPage = 2;
    private $_pageFrame = 8;
    private $_curPage = 1;
    
    public function getCollection($collection = 'null')
    {
        if($collection != 'null'){
            $page = $this->getRequest()->getParam('p');
            if($page) $this->_curPage = $page;
            
            $collection->setCurPage($this->_curPage);
            $collection->setPageSize($this->_itemPerPage);
            return $collection;
        }
    }
    
    public function getPagersHtml($collection = 'null')
    {    
        $html = false;
        if($collection == 'null') return;
        if($collection->count() > $this->_itemPerPage)
        {
            $curPage = $this->getRequest()->getParam('p');
            $pager = (int)($collection->count() / $this->_itemPerPage);
            $count = ($collection->count() % $this->_itemPerPage == 0) ? $pager : $pager + 1 ;
            $url = $this->getPagersUrl();
            $start = 1;
            $end = $this->_pageFrame;
            
            $html .= '<ol>';
            if(isset($curPage) && $curPage != 1){
                $start = $curPage - 1;                                        
                $end = $start + $this->_pageFrame;
            }else{
                $end = $start + $this->_pageFrame;
            }
            if($end > $count){
                $start = $count - ($this->_pageFrame-1);
            }else{
                $count = $end-1;
            }
            
            for($i = $start; $i<=$count; $i++)
            {
                if($i >= 1){
                    if($curPage){
                        $html .= ($curPage == $i) ? '<li class="current">'. $i .'</li>' : '<li><a href="'.$url.'&p='.$i.'">'. $i .'</a></li>';
                    }else{
                        $html .= ($i == 1) ? '<li class="current">'. $i .'</li>' : '<li><a href="'.$url.'&p='.$i.'">'. $i .'</a></li>';
                    }
                }
                
            }
            
            $html .= '</ol>';
        }
        
        return $html;
    }
    
    public function getPagersUrl()   // You need to change this function as per your url.
    {
        $cur_url = mage::helper('core/url')->getCurrentUrl();
        $new_url = preg_replace('/\&p=.*/', '', $cur_url);
        
        return $new_url;
    }

}
