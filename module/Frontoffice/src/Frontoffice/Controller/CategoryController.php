<?php
/**
 * Created by PhpStorm.
 * User: alberish
 * Date: 20/02/16
 * Time: 19:10
 */

namespace Frontoffice\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class CategoryController extends AbstractActionController
{
    /**
     * @var CaService
     */
    private $productService;

    public function setProductService($productService)
    {
        $this->productService = $productService;
    }

    public function getProductService()
    {
        return $this->productService;
    }


    public function categoryAction()
    {
        return new ViewModel();
    }

    public function productAction() {
        $product = $this->getProductService()->find($this->params('id'));
        return array( 'product' => $product);
    }
}