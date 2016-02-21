<?php
namespace Frontoffice\Controller;

use Frontoffice\Form\WishListForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductController extends AbstractActionController
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
        $products = $this->getProductService()->find($this->params('category'));
    }

    public function productAction() {

        $product = $this->getProductService()->find($this->params('id'));
        return array( 'product' => $product);
    }
}
