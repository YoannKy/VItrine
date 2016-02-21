<?php
namespace Frontoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\WhishListForm;
use Zend\View\Model\ViewModel;
use Frontoffice\Form\WishListForm;
use Application\Entity\Users;

class ProductController extends AbstractActionController
{
    /**
     * @var CaService
     */
    private $productService;

    private $categoryService;
    
    private $userService;
    
    public function setProductService($productService)
    {
        $this->productService = $productService;
    }

    public function getProductService()
    {
        return $this->productService;
    }
    
    public function setCategoryService($categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function getCategoryService()
    {
        return $this->categoryService;
    }
    
    public function setUserService($userService)
    {
        $this->userService = $userService;
    }
    
    public function getUserService()
    {
        return $this->userService;
    }
    
    
    protected function checkIfCategoryExists($categoryId){
    
        $id = (int) $categoryId;
        if (!$id) {
            return false;
        }
    
        $category = $this->getCategoryService()->find($id);
    
        if($category == null){
            return false;
        }
        return $category;
    }
    
    protected function checkIfProductExists($productId){
    
        $id = (int) $productId;
        if (!$id) {
            return false;
        }
    
        $product = $this->getProductService()->find($id);
    
        if($product == null){
            return false;
        }
        return $product;
    }


    public function indexAction()
    {
        $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
        if($category)   {
            $products = $category->getProducts();
             return array( 'products' => $products);
        } else {
            return $this->redirect()->toRoute('fo-category', array(
                'action' => 'index',
            ));
        }
    }

    public function showAction() { 
        $categoryExist =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
        $productExist =$this->checkIfProductExists( $this->params()->fromRoute('id'));
        $form = new WishListForm();
        $user = new Users();
        if($categoryExist and $productExist) {
            $product = $this->getProductService()->find($this->params()->fromRoute('id'));
            $form->bind($user);
            $request = $this->getRequest();
            if ($request->isPost()) {
                $authService = $this->getServiceLocator()->get('authentification_service');
                
                $entityService =  $this->getUserService();
                $user =  $authService->getIdentity();
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $user->getProducts()->add($product);
                    $entityService->persist($user);
                    return $this->redirect()->toRoute('fo-product', array(
                        'action' => 'show',
                        'id_category' =>  $this->params()->fromRoute('id_category'),
                        'id' =>  $this->params()->fromRoute('id'),
                    ));
                }
            }
            return array('form' => $form, 'product' => $product,'id_category'=>$this->params()->fromRoute('id_category'));
        }
        return $this->redirect()->toRoute('fo-category', array(
            'action' => 'index'));
        
    }
}
