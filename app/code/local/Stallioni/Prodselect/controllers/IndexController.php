<?php
class Stallioni_Prodselect_IndexController extends Mage_Core_Controller_Front_Action
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
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Product Selection'));
		$this->getLayout()->getBlock('content')->append(
		$this->getLayout()->createBlock('core/template')->setTemplate('stallioni/prodselect/prod-select.phtml')
		);
		$this->renderLayout();
    }
    public function prodsavesAction()
    {
		$this->loadLayout();
		$postvalues = $this->getRequest()->getParams();		
		$cust_id= $postvalues['cust_id'];
		$postedvalues= serialize($postvalues['prod_select']);		
		$coreResource = Mage::getSingleton('core/resource');	
		$conn = $coreResource->getConnection('core_read');
		$conn1 = $coreResource->getConnection('core_write');			
		$_fields = array();
		$_fields['vendorid'] = $cust_id;
		$_fields['selectproducts'] = $postedvalues;
		$query = 'SELECT vendorid FROM prodselect WHERE vendorid = '. (int)$cust_id;
		$selectquery = $conn->fetchAll($query);
		$count = count($selectquery);
		if($count=='1')
		{
			$conn1->update('prodselect',$_fields,array('vendorid = ?' => $cust_id));
			echo "committed";
		}else{
			$conn1->insert('prodselect', $_fields);  
			echo "committed";
		}			
	}
 }
