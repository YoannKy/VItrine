<?php 
namespace Application\Service;


use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventManager;

class AccessControlService
{
    protected $eventManager;
    protected $authentificationService;
    
  
    /**
    * Inject an AuthentificationServce instance
    *
    * @param  AuthentificationService $authentificationService
    * @return AuthentificationService
    */
    public function setAuthentificationService(AuthenticationService $authentificationService){
        $this->authentificationService = $authentificationService;
    }
    
    /**
     * Retrieve the authentification service
     *
     * @return AuthentificationService
     */
    public function getAuthentificationService(){
        return  $this->authentificationService;
    }
       
    
    public function checkPermission($module){
        $authService = $this->getAuthentificationService();
        if($authService->hasIdentity()){
            $user = $authService->getIdentity();
            $status = $user->getStatus();
            if($status == 'client' && $module == "backoffice"){
                return false;
            } else if ($status == 'admin' && $module == "backoffice"){
                return true;
            }
        } else {
            return false;
        }
    }
}
