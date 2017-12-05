<?php namespace Crisu83\Overseer\Doctrine\Storage;

use Crisu83\Overseer\Entity\Permission;
use Crisu83\Overseer\Contract\Permission as PermissionContract;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PermissionStorage implements \Crisu83\Overseer\Storage\PermissionStorage
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @param EntityManager $entityManager
     * @param string $entityClass
     */
    public function __construct(EntityManager $entityManager, $entityClass = Permission::class)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($entityClass);
    }


    /**
     * @inheritdoc
     */
    public function savePermission(PermissionContract $permission)
    {
        $this->entityManager->persist($permission);
        $this->entityManager->flush($permission);
    }


    /**
     * @@inheritdoc
     */
    public function getPermission($name)
    {
        return $this->repository->findOneBy(['name' => $name]);
    }


    /**
     * @inheritdoc
     */
    public function clearPermissions()
    {
        $conn = $this->entityManager->getConnection();
        $conn->executeQuery('TRUNCATE `rbac_permissions`');
    }
}
