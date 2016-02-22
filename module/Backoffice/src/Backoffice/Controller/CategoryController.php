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
use Backoffice\Form\CategoryForm;
use Application\Entity\Categories as Category;
use Zend\View\Helper\ViewModel;


class CategoryController extends AbstractActionController
{
    /**
     * @var CaService
     */
    protected $categoryService;
    
    protected $accessControlService;
    
    protected  $authentificationService;
    
//     protected $categoryFormService;
     
    public function __construct($categoryService/*, $categoryFormService*/)
    {
        $this->categoryService = $categoryService;
        
        //   $this->categoryFormService = $categoryFormService; 
    }

    public function getCategoryService()
    {
        return $this->categoryService;
    }
        
//     public function getCategoryFormService(){
//         return $this->categoryFormService;
//     }

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
    
    public function indexAction()
    { 
        $categories = $this->getCategoryService()->findAll();            
        return array( 'categories' => $categories);
    }
    
    public function newAction()
    {
       $form = new CategoryForm();
        $category = new Category();
     
        $form->bind($category); 
    
        $request = $this->getRequest();
        if ($request->isPost()) {
           $entityService =  $this->getCategoryService();
           $form->setData($request->getPost());          
            if ($form->isValid()) {
                $entityService->persist($category);
                return $this->redirect()->toRoute('category');
            }
        }
        return array('form' => $form);
    
    }
    
    public function editAction()
    {
            $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id'));
            if($category){
                $form  = new CategoryForm();
                $form->bind($category);
                $form->get('submit')->setAttribute('value', 'Edit');
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $form->setData($request->getPost());
                    if ($form->isValid()) {
                        $this->getCategoryService()->persist($category);
                        // Redirect to list of categories
                        return $this->redirect()->toRoute('category');
                    }
                }
                
                return array(
                    'id' => $category->getId(),
                    'form' => $form,
                );
            }
            else {
                return $this->redirect()->toRoute('category', array(
                    'action' => 'new',
                ));
            }
    }
    
    public function deleteAction(){
        $category =$this->checkIfCategoryExists( $this->params()->fromRoute('id'));
        if($category){
            $this->getCategoryService()->remove($category);
            // Redirect to list of categories
            return $this->redirect()->toRoute('category');
        }          
    }
    
    public function notallowedAction(){
        return array();
    }
}
