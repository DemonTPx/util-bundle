<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @copyright 2018 Bert Hekman
 */
abstract class AbstractEntityRepository
{
    protected ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository($this->getClassName());
    }

    abstract protected function getClassName(): string;
}
