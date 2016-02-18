<?php
namespace Application\Service;

use  Application\Service\DoctrineEntityService;

class CategoryService extends DoctrineEntityService
{
    public function getEntityRepository()
    {
        if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Application\Entity\Categories'));
        }
        return $this->entityRepository;
    }
}