<?php namespace Crisu83\Overseer\Doctrine\Storage;

use Crisu83\Overseer\Entity\Role;
use Crisu83\Overseer\Contract\Role as RoleContract;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class RoleStorage implements \Crisu83\Overseer\Storage\RoleStorage
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ClassMetadata
     */
    private $metadata;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @param EntityManager $entityManager
     * @param string $entityClass
     */
    public function __construct(EntityManager $entityManager, $entityClass = Role::class)
    {
        $this->entityManager = $entityManager;
        $this->metadata = $this->entityManager->getClassMetadata($entityClass);
        $this->repository = $this->entityManager->getRepository($entityClass);
    }

    /**
     * @inheritdoc
     */
    public function saveRole(RoleContract $role)
    {
        $this->entityManager->persist($role);
        $this->entityManager->flush($role);
    }

    /**
     * @inheritdoc
     */
    public function getRole($name)
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    /**
     * @inheritdoc
     */
    public function clearRoles()
    {
        $conn = $this->entityManager->getConnection();
        $conn->executeQuery("TRUNCATE {$this->metadata->table['name']}");
    }
}
