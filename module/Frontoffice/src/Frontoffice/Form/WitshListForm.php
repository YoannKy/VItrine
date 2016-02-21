<?php
namespace Frontoffice\Form;

use Zend\Form\Form;
// use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class WishListForm extends Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setName('product')
        ->setHydrator(new ClassMethodsHydrator(false))
//         ->setInputFilter(new InputFilter())
        ->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'product_id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'order_list',
            'options' => array(
                'label' => '',
                 'label_attributes'=>array(
                    'class'=>'col-sm-4 control-label'
                 )
            ),
            'attributes'=> array(
                'type' => 'text',
                'required' => 'required',
                'class'=>'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'price',
            'options' => array(
                'label' => 'Prix du produit',
                 'label_attributes'=>array(
                    'class'=>'col-sm-4 control-label'
                 )
            ),
            'attributes' => array(
                'type' => 'int',
                'required' => 'required',
                'class'=>'form-control'
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'label' => 'Go',
                'id' => 'submit_button',
                'class'=>'"btn btn-primary'
            ),
        ));
    }
    
}