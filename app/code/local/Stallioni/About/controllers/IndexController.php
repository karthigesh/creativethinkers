<?php
class Stallioni_About_IndexController extends Mage_Core_Controller_Front_Action
{
	/**
     * Action list where need check enabled cookie
     *
     * @var array
     */
    protected $_cookieCheckActions = array('loginPost', 'createpost');

    /**
     * Retrieve customer session model object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }
	
	/* Default customer service page
     */
    public function indexAction()
    {
		if (!$this->_getSession()->isLoggedIn()) {
						$this->_redirect('customer/account/login');
						return;
		}
		$customer = Mage::getSingleton('customer/session')->getCustomer();
		$this->renderLayout();
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('About Us'));
		$this->getLayout()->getBlock('content')->append(
		$this->getLayout()->createBlock('core/template')->setTemplate('stallioni/about/about.phtml')
		);
		$this->renderLayout();
    }
    public function aboutsaveAction()
    {
		$postvalues = $this->getRequest()->getParams();
		$cust_id = $postvalues['cust_id'];
		$aboutcontent = $postvalues['tinycontent'];
		
		$coreResource = Mage::getSingleton('core/resource');	
		$conn = $coreResource->getConnection('core_read');
		$conn1 = $coreResource->getConnection('core_write');			
		$_fields = array();
		$_fields['vendorid'] = $cust_id;
		$_fields['about'] = $aboutcontent;
		$query = 'SELECT vendorid FROM vendorpage_about WHERE vendorid = '. (int)$cust_id;
		$selectquery = $conn->fetchAll($query);
		$count = count($selectquery);
		if($count=='1')
		{
			$conn1->update('vendorpage_about',$_fields,array('vendorid = ?' => $cust_id));
			echo "committed";
		}else{
			$conn1->insert('vendorpage_about', $_fields);  
			echo "committed";
		}			
	}
    
 }
