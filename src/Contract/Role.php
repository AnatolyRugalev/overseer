<?php

namespace Crisu83\Overseer\Contract;

interface Role
{

    public function getName();

    public function hasPermissions();

    public function hasRoles();

    public function getPermissions();

    public function getRoles();

}