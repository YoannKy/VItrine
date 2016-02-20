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
    
    public function __construct($productService, $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
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
            return $this->redirect()->toRoute('category', array(
                'action' => 'index',
            ));
        }
    }
    
    public function newAction()
    {

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
    }
    
    public function editAction()
    {
        $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id_category'));
        $product =$this->checkIfProductExists( $this->params()->fromRoute('id'));
        if($category and $product) {
            $form  = new ProductForm();
            $form->bind($product);
            $form->get('submit')->setAttribute('value', 'Edit');
            $request = $this->getRequest();
            if ($request->isPost()) {
                $productService =  $this->getProductService();
                $categoryService =  $this->getCategoryService();
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $category->getProducts()->add($product);
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
