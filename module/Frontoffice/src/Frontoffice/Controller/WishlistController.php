<?php
namespace Frontoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Frontoffice\Form\WishListForm;

class WishlistController extends AbstractActionController
{
    /**
     * @var CaService
     */
    protected $authService;

    protected  $productService;
    
    protected $userService;
    
    public function setAuthentificationService($authService)
    {
        $this->authService = $authService;
    }
    
    public function getAuthentificationService()
    {
        return $this->authService;
    }
    
    public function setProductService($productService)
    {
        $this->productService = $productService;
    }
    
    public function getProductService()
    {
        return $this->productService;
    }
    
    public function setUserService($userService)
    {
        $this->userService = $userService;
    }
    
    public function getUserService()
    {
        return $this->userService;
    }
    
    public function indexAction()
    {
        $authService = $this->getServiceLocator()->get('authentification_service');
        $user = $authService->getIdentity();
        $form = new WishListForm();
        $form->bind($user);
        $products = $user->getProducts();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data =$request->getPost();
            $product = $this->getProductService()->find((int)$data['product_id']);
            $form->setData($data);
            if ($form->isValid() && $products->contains($product)) {
                $entityManager = $this->getUserService();
                $user->getProducts()->removeElement($product);
                $entityManager->persist($user);
            }  
        }
        return array('products' => $products, 'form' => $form);        
    }
}
