<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @copyright 2018 Bert Hekman
 */
abstract class AbstractEntityRepository
{
    /** @var EntityRepository */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository($this->getClassName());
    }

    abstract protected function getClassName(): string;
}
