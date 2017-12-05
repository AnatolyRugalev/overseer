<?php

namespace Crisu83\Overseer\Contract;

use Crisu83\Overseer\Exception\PermissionNotFound;
use Crisu83\Overseer\Exception\RoleNotFound;
use Crisu83\Overseer\Contract\Resource as ResourceContract;

interface Overseer
{

    /**
     * @param Role $role
     */
    public function saveRole(Role $role);

    /**
     * Clear the roles.
     */
    public function clearRoles();

    /**
     * @param Permission $permission
     */
    public function savePermission(Permission $permission);

    /**
     * Clear the permissions.
     */
    public function clearPermissions();

    /**
     * @param Assignment $assignment
     */
    public function saveAssignment(Assignment $assignment);

    /**
     * @param string $subjectId
     * @param string $subjectName
     *
     * @return Assignment
     */
    public function getAssignment($subjectId, $subjectName);

    /**
     * @param Assignment $assignment
     */
    public function deleteAssignment(Assignment $assignment);

    /**
     * Clear the assignments.
     */
    public function clearAssignments();


    /**
     * @param Subject $subject
     * @param ResourceContract|null $resource
     * @param array $params
     *
     * @return array
     * @throws PermissionNotFound
     */
    public function getPermissions(Subject $subject, ResourceContract $resource = null, array $params = []);


    /**
     * @param string $permissionName
     * @param Subject $subject
     * @param ResourceContract|null $resource
     * @param array $params
     *
     * @return bool
     */
    public function hasPermission(
        $permissionName,
        Subject $subject,
        ResourceContract $resource = null,
        array $params = []
    );


    /**
     * @param Subject $subject
     *
     * @return Assignment|null
     */
    public function getAssignmentForSubject(Subject $subject);


    /**
     * @param Subject $subject
     *
     * @return Role[]
     * @throws RoleNotFound
     */
    public function getRolesForSubject(Subject $subject);

}
