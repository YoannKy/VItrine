<?php
namespace Backoffice\Form;

use Zend\Form\Form;
// use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class CategoryForm extends Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setName('login')
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
            'attributes' => array(
                'type' => 'text',
                'label' => 'nom',
                'required' => 'required',
                'class'=>'form-control'
            ),
        ));
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'label' => 'nom',
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