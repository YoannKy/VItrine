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

    public function indexAction(){
        
        $categories = $this->getCategoryService()->findAll();
        
        return array( 'categories' => $categories);
    }  
}