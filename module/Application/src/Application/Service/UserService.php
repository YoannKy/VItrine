<?php
namespace Application\Service;

use  Application\Service\DoctrineEntityService;

class UserService extends DoctrineEntityService
{
    public function getEntityRepository()
    {
        if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Application\Entity\Users'));
        }
        return $this->entityRepository;
    }
}