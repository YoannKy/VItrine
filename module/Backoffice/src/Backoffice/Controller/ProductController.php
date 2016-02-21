<?php
/** 
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Backoffice\Form\ProductForm;
use Application\Entity\Products as Product;


class ProductController extends AbstractActionController
{
    /**
     * @var CaService
     */
    protected  $productService;
    
    protected  $categoryService;
    
    protected $accessControlService;
    
    public function __construct($productService, $categoryService, $accessControlService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->accessControlService = $accessControlService;
    }
    
    public function setCategoryService($categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function getCategoryService()
    {
        return $this->categoryService;
    } 
    
    
    public function setProductService($productService)
    {
        $this->productService = $productService;
    }
    
    public function getProductService()
    {
        return $this->productService;
    }
    

    public function getAccessControlService()
    {
        return $this->accessControlService;
    }
    

    public function getModuleName(){
        return  explode("-",$this->getEvent()->getRouteMatch()->getParam('controller'))[0];
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
        $acessControlService = $this->getAccessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
            $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
            if($category)   {
                $products = $category->getProducts();
                 return array( 'products' => $products,'id_category'=> $this->params()->fromRoute('id_category'));
            } else {
                return $this->redirect()->toRoute('category', array(
                    'action' => 'index',
                ));
            }
        } else {
            return $this->redirect()->toRoute('home', array(
                'controller' => 'frontoffice-product',
                'action' =>  'last'
            ));
        }
    }
    
    public function newAction()
    {

        $acessControlService = $this->getAccessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
            $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
            if($category)   {
                $form = new ProductForm();
                $product = new Product();
             
                $form->bind($product); 
            
                $request = $this->getRequest();
                if ($request->isPost()) {
                   $productService =  $this->getProductService();
                   $categoryService =  $this->getCategoryService();
                   
                   $form->setData($request->getPost());          
                    if ($form->isValid()) {
                        $category->getProducts()->add($product);
                        $productService->persist($product);
                        $categoryService->persist($category);
                        return $this->redirect()->toRoute('product',array('id_category'=>$category->getId()));
                    }
                }
                return array(
                    'id'=>$category->getId(),
                    'form' => $form 
                );
            } else {
                return $this->redirect()->toRoute('category', array(
                    'action' => 'index',
                ));
            }
        } else {
            return $this->redirect()->toRoute('home', array(
                'controller' => 'frontoffice-product',
                'action' =>  'last'
            ));
        }
    }
    
    public function editAction()
    {
        $acessControlService = $this->getAccessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
            $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
            $product =$this->checkIfProductExists( $this->params()->fromRoute('id'));
            if($category and $product) {
                $productService =  $this->getProductService();
                $categoryService =  $this->getCategoryService();
                $product = $productService->find($this->params()->fromRoute('id'));
                $form  = new ProductForm();
                $form->bind($product);
                $form->get('submit')->setAttribute('value', 'Edit');
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $form->setData($request->getPost());
                    if ($form->isValid()) {
                        $productService->persist($product);
                        $categoryService->persist($category);
                        // Redirect to list of products
                        return $this->redirect()->toRoute('product', array('id_category'=>$category->getId()));
                    }
                }
                
                return array(
                    'id' => $product->getId(),
                    'id_category' => $category->getId(),
                    'form' => $form,
                );
                
            } else {
               if($category){
                   return $this->redirect()->toRoute('product', array(
                       'action' => 'new',
                       'id_category'=>$category->getId(),
                   ));
                   
               } else {
                return $this->redirect()->toRoute('product', array(
                    'action' => 'new',
                ));
               }
            }
        }
    }
}
