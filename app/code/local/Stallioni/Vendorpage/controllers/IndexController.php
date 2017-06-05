<?php
class Stallioni_Vendorpage_IndexController extends Mage_Core_Controller_Front_Action
{
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
    public function indexAction()
    {
		if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('customer/account/login');
            return;
        }
        $this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__('Vendor Admin'));
		$this->getLayout()->getBlock('content')->append(
		 //$this->getLayout()->createBlock('stallioni/vendorpage/dashboard')
		 $this->getLayout()->createBlock('core/template')->setTemplate('stallioni/vendorpage/vendor-admin.phtml')
        );
		$this->renderLayout();
    }
    public function vendorsavesAction()
    {
		$postvalues = $this->getRequest()->getParams();	
		if(isset($_FILES['vendorlogo']['name']) && $_FILES['vendorlogo']['name'] != '')
			{
				try
				{       
					$path = Mage::getBaseDir('skin').DS.'frontend'.DS.'sm_market'.DS.'default'.DS.'images'.DS.'customerlogo'.DS;  //desitnation directory     
					$fname = $_FILES['vendorlogo']['name']; //file name                        
					$uploader = new Varien_File_Uploader('vendorlogo'); //load class
					$uploader->setAllowedExtensions(array('jpg','png','jpeg')); //Allowed extension for file
					$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
					$uploader->setAllowRenameFiles(true); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
					$uploader->setFilesDispersion(false);
					$img = $uploader->save($path,$fname); //save the file on the specified path					 
				}
				catch (Exception $e)
				{
					echo 'Error Message: '.$e->getMessage();
				}
			}
			$imag_path = Mage::getDesign()->getSkinUrl().'images'.DS.'customerlogo'.DS.$img['file'];
			$cust_id= $postvalues['cust_id'];
			$vendornamebefore= $postvalues['vendorname'];
			$vendorname = preg_replace('#[ -]+#', '-', $vendornamebefore);
			$vendortel= $postvalues['vendortel'];
			$vendoremail = $postvalues['vendoremail'];
			$vendaddress= $postvalues['vendaddress'];
			$coreResource = Mage::getSingleton('core/resource');	
			$conn = $coreResource->getConnection('core_read');
			$conn1 = $coreResource->getConnection('core_write');			
			$_fields = array();
			$_fields['vendor_id'] = $cust_id;
			$_fields['vendorname'] = $vendorname;
			$_fields['vendorlogo'] = $imag_path;
			$_fields['vendoremail'] = $vendoremail;
			$_fields['vendorphone'] = $vendortel;
			$_fields['address'] = $vendaddress;
			$customer = Mage::getModel('customer/customer')->load($cust_id)->getData();
			$customer_address_id = $customer['default_billing'];
			$defaultBillingAddress = Mage::getModel('customer/address')->load($customer_address_id);
			$adminemail = Mage::getStoreConfig('trans_email/ident_general/email');
			$customer_email = $customer['email'];
			$to      = $adminemail;
			$subject = 'New Distributor Site Created';
			$message = '<table>';
			$message .= '<tr><td>Distributor Id: </td><td>'.$cust_id.'</td></tr>';
			$message .= '<tr><td>Distributor Name: </td><td>'.$vendorname.'</td></tr>';
			$message .= '<tr><td>Phone: </td><td>'.$vendortel.'</td></tr>';
			$message .= '<tr><td>Email: </td><td>'.$vendoremail.'</td></tr>';
			$message .= '<tr><td>Address:</td><td>'.$vendaddress.'</td></tr>';
			$message .= '<tr><td>Url:</td><td>'.Mage::getBaseUrl().'shop/'.$vendorname.'</td></tr>';
			$message .= '</table>';
			$headers  = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .='X-Mailer: PHP/' . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'From:'. $vendoremail . "\r\n" .
			'Reply-To:'. $vendoremail .  "\r\n" .
			'X-Mailer: PHP/' . phpversion();			
				$conn1->insert('vendorpage', $_fields); 
				$mail=mail($to, $subject, $message, $headers);	
				echo "committed";
	 }
    public function vendoroldsavesAction()
    {
		$postvalues = $this->getRequest()->getParams();		
			$cust_id= $postvalues['cust_id'];
			$vendornamebefore= $postvalues['vendorname'];
			$vendorname = preg_replace('#[ -]+#', '-', $vendornamebefore);
			$vendortel= $postvalues['vendortel'];
			$vendoremail = $postvalues['vendoremail'];
			$vendaddress= $postvalues['vendaddress'];
			$coreResource = Mage::getSingleton('core/resource');	
			$conn = $coreResource->getConnection('core_read');
			$conn1 = $coreResource->getConnection('core_write');			
			$_fields = array();
			$_fields['vendor_id'] = $cust_id;
			$_fields['vendorname'] = $vendorname;
			$_fields['vendoremail'] = $vendoremail;
			$_fields['vendorphone'] = $vendortel;
			$_fields['address'] = $vendaddress;
			$adminemail = Mage::getStoreConfig('trans_email/ident_general/email');
			$customer_email = $vendoremail;
			$to      = $adminemail;
			$subject = 'Distributor Site has been modified';
			$message = '<table>';
			$message .= '<tr><td>Distributor Id: </td><td>'.$cust_id.'</td></tr>';
			$message .= '<tr><td>Distributor Name: </td><td>'.$vendorname.'</td></tr>';
			$message .= '<tr><td>Phone: </td><td>'.$vendortel.'</td></tr>';
			$message .= '<tr><td>Address:</td><td>'.$vendaddress.'</td></tr>';
			$message .= '<tr><td>Url:</td><td>'.Mage::getBaseUrl().'shop/'.$vendorname.'</td></tr>';
			$message .= '</table>';
			$headers  = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .='X-Mailer: PHP/' . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'From:'. $customer_email . "\r\n" .
			'Reply-To:'. $customer_email .  "\r\n" .
			'X-Mailer: PHP/' . phpversion();			
				$conn1->update('vendorpage',$_fields,array('vendor_id = ?' => $cust_id));
				$mail=mail($to, $subject, $message, $headers);
				echo "committed";
	 }
	 public function vendorlogosavesAction()
	 {
		 $postvalues = $this->getRequest()->getParams();	
		 if(isset($_FILES['vendornewlogo']['name']) && $_FILES['vendornewlogo']['name'] != '')
			{
				try
				{       
					$path = Mage::getBaseDir('skin').DS.'frontend'.DS.'sm_market'.DS.'default'.DS.'images'.DS.'customerlogo'.DS;  //desitnation directory     
					$fname = $_FILES['vendornewlogo']['name']; //file name                        
					$uploader = new Varien_File_Uploader('vendornewlogo'); //load class
					$uploader->setAllowedExtensions(array('jpg','png','jpeg')); //Allowed extension for file
					$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
					$uploader->setAllowRenameFiles(true); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
					$uploader->setFilesDispersion(false);
					$img = $uploader->save($path,$fname); //save the file on the specified path					 
				}
				catch (Exception $e)
				{
					echo 'Error Message: '.$e->getMessage();
				}
			}
			$imag_path = Mage::getDesign()->getSkinUrl().'images'.DS.'customerlogo'.DS.$img['file'];
			$coreResource = Mage::getSingleton('core/resource');	
			$conn = $coreResource->getConnection('core_write');
			$_fields = array();
			$_fields['vendorlogo'] = $imag_path;
			$cust_id= $postvalues['cust_id'];
			$conn->update('vendorpage',$_fields,array('vendor_id = ?' => $cust_id));
			echo "committed";
	 }
	 public function vendoradminsavesAction()
    {
			$postvalues = $this->getRequest()->getParams();		
		if(isset($_FILES['vendorlogo']['name']) && $_FILES['vendorlogo']['name'] != '')
			{
				try
				{       
					$path = Mage::getBaseDir('skin').DS.'frontend'.DS.'sm_market'.DS.'default'.DS.'images'.DS.'customerlogo'.DS;  //desitnation directory     
					$fname = $_FILES['vendorlogo']['name']; //file name                        
					$uploader = new Varien_File_Uploader('vendorlogo'); //load class
					$uploader->setAllowedExtensions(array('jpg','png','jpeg')); //Allowed extension for file
					$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
					$uploader->setAllowRenameFiles(true); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
					$uploader->setFilesDispersion(false);
					$img = $uploader->save($path,$fname); //save the file on the specified path					 
				}
				catch (Exception $e)
				{
					echo 'Error Message: '.$e->getMessage();
				}
			}
			$imag_path = Mage::getDesign()->getSkinUrl().'images'.DS.'customerlogo'.DS.$img['file'];
			//print_r($postvalues);
			$cust_id= $postvalues['cust_id'];
			$vendornamebefore= $postvalues['vendorname'];
			$vendorname = preg_replace('#[ -]+#', '-', $vendornamebefore);
			$vendortel= $postvalues['vendortel'];
			$vendaddress= $postvalues['vendaddress'];
			$coreResource = Mage::getSingleton('core/resource');	
			$conn = $coreResource->getConnection('core_read');
			$conn1 = $coreResource->getConnection('core_write');			
			$_fields = array();
			$_fields['vendor_id'] = $cust_id;
			$_fields['vendorname'] = $vendorname;
			$_fields['vendorlogo'] = $imag_path;
			$_fields['vendorphone'] = $vendortel;
			$_fields['address'] = $vendaddress;
			$query = 'SELECT vendor_id FROM vendorpage WHERE vendor_id = '. (int)$cust_id;
			$selectquery = $conn->fetchAll($query);
			$count = count($selectquery);				
			if($count=='1')
			{
				$conn1->update('vendorpage',$_fields,array('vendor_id = ?' => $cust_id));
				echo "committed";
			}else{
				$conn1->insert('vendorpage', $_fields); 
				echo "committed";
			}	
	 }

}
