<?php
namespace Backoffice\Form;

use Zend\Form\Form;
// use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class ProductForm extends Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setName('product')
        ->setHydrator(new ClassMethodsHydrator(false))
//         ->setInputFilter(new InputFilter())
        ->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        
        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'nom',
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
            'name' => 'shortDesc',
            'options' => array(
                'label' => 'Description courte',
                'label_attributes'=>array(
                    'class'=>'col-sm-4 control-label'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'class'=>'form-control'
            ),
        ));
        
        $this->add(array(
            'name' => 'longDesc',
            'options' => array(
                'label' => 'Description longue',
                'label_attributes'=>array(
                    'class'=>'col-sm-4 control-label'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'label' => 'description longue',
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