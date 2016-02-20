<?php
namespace Application\Form;

use Zend\Form\Form;
// use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserForm extends Form
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
            'name' => 'mail',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'class'=>'form-control input-lg',
                'placeholder'=>'user@gmail.com'
            ),
        ));
        

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'class'=>'form-control input-lg',
                'placeholder'=>'nom'
            ),
        ));
        
          $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'required' => 'required',
                'class'=>'form-control input-lg',
                'placeholder'=>'mot de passe'
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