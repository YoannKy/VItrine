<?php
namespace Frontoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WishlistController extends AbstractActionController
{
    /**
     * @var CaService
     */
    protected $authService;

    
    
    public function setAuthentificationService($authService)
    {
        $this->authService = $authService;
    }
    
    public function getAuthentificationService()
    {
        return $this->authService;
    }
    
    public function indexAction()
    {
        $authService = $this->getServiceLocator()->get('authentification_service');
         
        $products = $authService->getIdentity()->getProducts();
         return array('products' => $products);
        
    }
}
