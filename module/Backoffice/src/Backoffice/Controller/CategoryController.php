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


class CategoryController extends AbstractActionController
{
    /**
     * @var CaService
     */
    protected $categoryService;
    
    protected $accessControlService;
    
    protected  $authentificationService;
    
//     protected $categoryFormService;
     
    public function __construct($categoryService/*, $categoryFormService*/, $accessControlService)
    {
        $this->categoryService = $categoryService;
        
        $this->accessControlService = $accessControlService;
        //   $this->categoryFormService = $categoryFormService; 
    }

    public function getCategoryService()
    {
        return $this->categoryService;
    }
    
    public function getAuthentificationService(){
        return $this->authentificationService;
    }
    
    
    public function getModuleName(){
        return  explode("-",$this->getEvent()->getRouteMatch()->getParam('controller'))[0];
    }
    
    
    public function getAcessControlService()
    {
        return $this->accessControlService;
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
        $acessControlService = $this->getAcessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
            $categories = $this->getCategoryService()->findAll();            
            return array( 'categories' => $categories);
        } else {
            return "not authorized";
        }
        
    }
    
    public function newAction()
    {
        $acessControlService = $this->getAcessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
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
        } else {
            return "not authorized";
        }
    }
    
    public function editAction()
    {
        $acessControlService = $this->getAcessControlService();
        $module = $this->getModuleName();
        if($acessControlService->checkPermission($module)){
        
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
        } else {
            return "no authorized";
        }
    }
}
