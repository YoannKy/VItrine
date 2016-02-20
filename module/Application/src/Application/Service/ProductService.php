<?php
namespace Application\Service;

use  Application\Service\DoctrineEntityService;

class ProductService extends DoctrineEntityService
{
    public function getEntityRepository()
    {
        if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Application\Entity\Products'));
        }
        return $this->entityRepository;
    }
}