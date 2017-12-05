<?php namespace Crisu83\Overseer\Storage;

use Crisu83\Overseer\Contract\Assignment;

interface AssignmentStorage
{

    /**
     * @param Assignment $assignment
     */
    public function saveAssignment(Assignment $assignment);


    /**
     * @param Assignment $assignment
     */
    public function deleteAssignment(Assignment $assignment);


    /**
     * @param mixed $subjectId
     * @param string $subjectName
     *
     * @return Assignment
     */
    public function getAssignment($subjectId, $subjectName);


    /**
     * Clear the assignments.
     */
    public function clearAssignments();
}
