<?php
class Stallioni_Shop_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract{
    public function initControllerRouters($observer){
        $front = $observer->getEvent()->getFront();
        $front->addRouter('shop', $this);
        return $this;
    }
    public function match(Zend_Controller_Request_Http $request){
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }        
        $pathInfo = trim($request->getPathInfo(), '/');
        $params = explode('/', $pathInfo);
        if(isset($params[2])){
			if($params[2]=='about'){
			$request->setModuleName('shop')  
                     ->setControllerName('index')
                     ->setActionName('about');
            if (isset($params[1])){
                 $request->setParam('shop_name', $params[1]);
            }
            $request->setAlias(
                Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                $pathInfo
            );
            return true;
			}else if($params[2]=='contact'){
				$request->setModuleName('shop')  
					 ->setControllerName('index')
					 ->setActionName('contact');
				if (isset($params[1])){
				 $request->setParam('shop_name', $params[1]);
				}
				$request->setAlias(
				Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
				$pathInfo
				);
				return true;
			}else if($params[2]=='howtoorder'){
				$request->setModuleName('shop')  
					 ->setControllerName('index')
					 ->setActionName('howtoorder');
				if (isset($params[1])){
				 $request->setParam('shop_name', $params[1]);
				}
				$request->setAlias(
				Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
				$pathInfo
				);
				return true;
			}else if($params[2]=='prodid'){				
				$request->setModuleName('shop')
				  ->setControllerName('product')
				  ->setActionName('prods');
				  $prodset = array('shopname'=>$params[1],'prodid'=>$params[3]);				  
					$request->setParam('shopset', $prodset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='catid'){				
				$request->setModuleName('shop')
				  ->setControllerName('category')
				  ->setActionName('cats');
				  $prodset = array('shopname'=>$params[1],'catid'=>$params[3]);				  
					$request->setParam('shopset', $prodset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='appliques'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='distressing'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='fabricscolors'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='fasteners'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='flatembroidery'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='label'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='location'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='puff'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='screenprinting'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='structure'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='sublimation'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='trimpizzaz'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('page');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}else if($params[2]=='capoptions'){				
				$request->setModuleName('shop')
				  ->setControllerName('index')
				  ->setActionName('capoptions');
				  $pageset = array('shopname'=>$params[1],'pagename'=>$params[2]);				  
					$request->setParam('shopset', $pageset);
				$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$pathInfo
				);
				return true;
			}
		}
        if(isset($params[0]) && $params[0] == 'shop') {
             //redirect to mymodule/brands/index/brand_name/addidas
             $request->setModuleName('shop')  
                     ->setControllerName('index')
                     ->setActionName('index');
            if (isset($params[1])){
                 $request->setParam('shop_name', $params[1]);
            }
            
            $request->setAlias(
                Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                $pathInfo
            );
            return true;
        }
        return false;
    }
}
