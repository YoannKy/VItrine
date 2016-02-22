<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\AuthentificationForm;
use Application\Form\UserForm;
use Application\Entity\Users as User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mail\Transport\InMemory as InMemoryTransport;
class AuthentificationController extends AbstractActionController
{
    protected  $authentificationService;
    
    protected  $userService;
   
    
    public function __construct($authentificationService, $userService)
    {
        $this->authentificationService = $authentificationService;
        $this->userService = $userService;
    }
    
    public function setAuthentificationService($authentificationService)
    {
        $this->authentificationService = $authentificationService;
    }
    
    public function getAuthentificationService()
    {
        return $this->authentificationService;
    }
    
    
    public function setUserService($userService)
    {
        $this->userService = $userService;
    }
    
    public function getUserService()
    {
        return $this->userService;
    }
    
    
    public function indexAction()
    {
        $authService = $this->getServiceLocator()->get('authentification_service');
       
        if($authService->getIdentity()){

            $module = $this->getEvent()->getRouteMatch()->getParam('controller');
           return  $this->redirect()->toRoute('fo-category', array(
                'controller' => 'category',
                'action' =>  'index'
            ));
        } else {
            $form = new AuthentificationForm();
            $bcrypt = new Bcrypt();
            $request = $this->getRequest();
            if ($request->isPost()) {
                $data = $this->getRequest()->getPost();
                $form->setData($request->getPost());
                if($form->isValid()){    
                    $mail = $form->get('mail')->getValue();
                    $password = $form->get('password')->getValue();
                    
                    $entityService = $this->getUserService();
                    $user = $entityService->findOneBy(array('mail'=>$mail));
                    $hashedPassword = $bcrypt->verify($password,$user->getPassword());
                    
                    $adapter = $authService->getAdapter();
                    $adapter->setIdentityValue($mail);
                    $adapter->setCredentialValue($hashedPassword);
                    
                    $authResult = $authService->authenticate($adapter);
                    if ($authResult->isValid()) {
                        if($authService->getIdentity()->getStatus() == 'client'){
                           return  $this->redirect()->toRoute('fo-category', array(
                                'controller' => 'category',
                                'action' =>  'index'
                            ));
                        } else {
                            return $this->redirect()->toRoute('category', array(
                                'controller' => 'category',
                                'action' =>  'index'
                            ));
                        }
                    }
                }
            }
            
            return array('form' => $form);
        }
    }
    
    public function newAction()
    {
        $form = new UserForm();
        $user = new User();
        $bcrypt = new Bcrypt();
        
        $form->bind($user);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $entityService =  $this->getUserService();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $message = new \Zend\Mail\Message();
                $message->setBody('This is the body');
                $message->setFrom('albert.nguyen.pro14@gmail.com');
                $message->addTo('albert.nguyen.pro14@gmail.com');
                $message->setSubject('Test subject');

                $options = new Mail\Transport\SmtpOptions(array(
                    'name' => 'CRAM-MD5',
                    'host' => 'CRAM-MD5',
                    'port' => 2525,
                    'connection_class' => 'login',
                    'connection_config' => array(
                        'username' => '277bf72a5d6029',
                        'password' => '0ca2cdac081524',
                        'ssl'=> 'tls',
                    ),
                ));
                $transport = new \Zend\Mail\Transport\Smtp($options);
                $transport->send($message);
                die();
                $user->setPassword($bcrypt->create($user->getPassword()));
                $user->setStatus('client');
                $entityService->persist($user);


                return $this->redirect()->toRoute('login',array('action'=>'index'));
            }
            
        }
        return array('form' => $form);
    }
    
    public  function logoutAction(){
        $authService = $this->getServiceLocator()->get('authentification_service');
         
        $authService->clearIdentity();
        
        return $this->redirect()->toRoute('login', array(
                        'controller' => 'authentification',
                        'action' =>  'index'
                    ));
    }
        
    
}
