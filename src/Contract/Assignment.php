<?php

namespace Crisu83\Overseer\Contract;

interface Assignment
{

    /**
     * @return string
     */
    public function getSubjectId();

    /**
     * @return string
     */
    public function getSubjectName();

    /**
     * @return bool
     */
    public function hasRoles();

    /**
     * @return string[]
     */
    public function getRoles();

}