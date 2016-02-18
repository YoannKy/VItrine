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
    private $categoryService;
    
    public function setCategoryService($categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function getCategoryService()
    {
        return $this->categoryService;
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
        
        $id = (int) $this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('category', array(
                'action' => 'new',
            ));
        }
    
        try {
            $category = $this->getCategoryService()->find($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('category', array(
                'action' => 'index'
            ));
        }
    
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
            'id' => $id,
            'form' => $form,
        );
    }
}
