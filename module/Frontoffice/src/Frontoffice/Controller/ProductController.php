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
            $products =  $category->getProducts();
            
            return array( 'products' =>  $products,'id_category'=>$this->params()->fromRoute('id_category'));
        } else {
            return $this->redirect()->toRoute('fo-category', array(
                'action' => 'index',
            ));
        }
    }
    
    public function lastAction(){
        $productService = $this->getProductService();
    
        $products = $productService->findBy(array(), array('id' => 'DESC'), 2, 0);
    
        return array('products'=>$products);
    }

    public function showAction() { 
        $categoryExist =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
        $productExist =$this->checkIfProductExists( $this->params()->fromRoute('id'));
        $form = new WishListForm();
        if($categoryExist and $productExist) {
            $product = $this->getProductService()->find($this->params()->fromRoute('id'));
            $authService = $this->getServiceLocator()->get('authentification_service');
            if($authService->hasIdentity()){
                $user = $authService->getIdentity();
                $form->bind($user);
                $hasAlreadyWished = $user->getProducts()->contains($product); 
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $form->setData($request->getPost());
                    if ($form->isValid() && $hasAlreadyWished) {
                        $user->getProducts()->add($product);
                        $user->persist($user);
                    } else {
                        return $this->redirect()->toRoute('fo-product', array(
                            'action' => 'show',
                            'id_category' =>  $this->params()->fromRoute('id_category'),
                            'id' =>  $this->params()->fromRoute('id'),
                        ));
                    }
                }
            } else {
                $hasAlreadyWished = false;
            }
            return array('form' => $form, 'product' => $product,'hasAlreadyWished'=>$hasAlreadyWished,'id_category'=>$this->params()->fromRoute('id_category'));
        }
        return $this->redirect()->toRoute('home', array(
            'action' => 'last'));
    }
}
