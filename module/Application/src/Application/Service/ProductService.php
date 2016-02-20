<?php
namespace Application\Service;

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