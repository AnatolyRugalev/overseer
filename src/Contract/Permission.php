<?php

namespace Crisu83\Overseer\Contract;

use Crisu83\Overseer\Contract\Resource as ResourceContract;

interface Permission
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @return bool
     */
    public function hasRules();

    /**
     * @param ResourceContract $resource
     * @return bool
     */
    public function appliesToResource(ResourceContract $resource);

    /**
     * @param Subject $subject
     * @param ResourceContract $resource
     * @param array $params
     * @return bool
     */
    public function evaluate(Subject $subject, ResourceContract $resource, array $params);

}
