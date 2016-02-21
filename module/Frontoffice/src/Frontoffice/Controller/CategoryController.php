<?php

namespace Frontoffice\Controller;


use Zend\Mvc\Controller\AbstractActionController;

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
    
    
    public function getModuleName(){
        return  explode("-",$this->getEvent()->getRouteMatch()->getParam('controller'))[0];
    }

    public function indexAction(){       
        $categoryService = $this->getCategoryService();
        $categories = $categoryService->findAll();
        $paginator = $categoryService->paginate($categories);
        $paginator->setDefaultItemCountPerPage(10);
         
        $page = (int)$this->params()->fromRoute('page');
        if($page){
            $paginator->setCurrentPageNumber($page);
        }
        return array( 'categories' => $paginator,'page'=>$page);    
    }
}