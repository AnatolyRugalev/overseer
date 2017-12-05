<?php namespace Crisu83\Overseer\Contract;

use Crisu83\Overseer\Contract\Resource as ResourceContract;

interface Rule
{

    /**
     * @param Subject $subject
     * @param ResourceContract $resource
     * @param array $params
     *
     * @return bool
     */
    public function evaluate(Subject $subject, ResourceContract $resource, array $params);
}
