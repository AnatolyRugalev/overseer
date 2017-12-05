<?php namespace Crisu83\Overseer;

use Crisu83\Overseer\Entity\Assignment;
use Crisu83\Overseer\Entity\Permission;
use Crisu83\Overseer\Entity\Role;

class Builder
{

    /**
     * @var Overseer
     */
    protected $overseer;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var bool
     */
    protected $buildAssignments;


    /**
     * Builder constructor.
     *
     * @param Overseer $overseer
     * @param array $config
     * @param bool $buildAssignments
     */
    public function __construct(Overseer $overseer, array $config, $buildAssignments = true)
    {
        $this->overseer = $overseer;
        $this->config = $config;
        $this->buildAssignments = $buildAssignments;
    }


    /**
     * Build the assignments, roles and permissions based on configuration.
     */
    public function build()
    {
        $this->overseer->clearRoles();
        $this->saveRoles();

        $this->overseer->clearPermissions();
        $this->savePermissions();

        if ($this->buildAssignments) {
            $this->overseer->clearAssignments();
            $this->saveAssignments();
        }
    }


    protected function saveRoles()
    {
        $config = isset($this->config['roles']) ? $this->config['roles'] : [];
        foreach ($config as $roleName => $roleConfig) {
            $this->overseer->saveRole($this->createRole(
                $roleName,
                isset($roleConfig['inherits']) ? $roleConfig['inherits'] : [],
                isset($roleConfig['permissions']) ? $roleConfig['permissions'] : []
            ));
        }
    }

    protected function savePermissions()
    {
        $config = isset($this->config['permissions']) ? $this->config['permissions'] : [];
        foreach ($config as $permissionName => $permissionConfig) {
            $this->overseer->savePermission($this->createPermission(
                $permissionName,
                isset($permissionConfig['resource']) ? $permissionConfig['resource'] : null,
                isset($permissionConfig['rules']) ? $permissionConfig['rules'] : []
            ));
        }
    }

    protected function saveAssignments()
    {
        $config = isset($this->config['assignments']) ? $this->config['assignments'] : [];
        foreach ($config as $subjectId => $assignmentConfig) {
            $this->overseer->saveAssignment($this->createAssignment(
                $subjectId,
                isset($assignmentConfig['subject_name']) ? $assignmentConfig['subject_name'] : null,
                isset($assignmentConfig['roles']) ? $assignmentConfig['roles'] : []
            ));
        }
    }

    protected function createRole($name, array $roles, array $permissions)
    {
        return new Role($name, $roles, $permissions);
    }

    protected function createPermission($name, $resourceName, array $rules)
    {
        return new Permission($name, $resourceName, $rules);
    }

    protected function createAssignment($subjectId, $subjectName, array $roles)
    {
        return new Assignment($subjectId, $subjectName, $roles);
    }
}
