<?php

class Stallioni_Distributoradmin_IndexController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
    	// "Fetch" display
        $this->loadLayout();
        
        // "Inject" into display
        // THe below example will not actualy show anything since the core/template is empty
        $this->_addContent($this->getLayout()->createBlock('core/template')->setTemplate('stallioni/admin/admin.phtml'));
                
        // "Output" display
        $this->renderLayout();
    }   
    public function aboutAction()
    {
		// "Fetch" display
        $this->loadLayout();
        
        // "Inject" into display
        // THe below example will not actualy show anything since the core/template is empty
        $this->_addContent($this->getLayout()->createBlock('core/template')->setTemplate('stallioni/admin/about.phtml'));
                
        // "Output" display
        $this->renderLayout();
	} 	
    public function complimentaryAction()
    {
		// "Fetch" display
        $this->loadLayout();
        
        // "Inject" into display
        // THe below example will not actualy show anything since the core/template is empty
        $this->_addContent($this->getLayout()->createBlock('core/template')->setTemplate('stallioni/admin/compliment.phtml'));
                
        // "Output" display
        $this->renderLayout();
	} 	
	public function vendorproductsAction()
	{
		// "Fetch" display
        $this->loadLayout();
        
        // "Inject" into display
        // THe below example will not actualy show anything since the core/template is empty
        $this->_addContent($this->getLayout()->createBlock('core/template')->setTemplate('stallioni/admin/productselection.phtml'));
                
        // "Output" display
        $this->renderLayout();
	}
}
