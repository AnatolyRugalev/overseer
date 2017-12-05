<?php

use Crisu83\Overseer\Contract\Resource as ResourceContract;
use Crisu83\Overseer\Contract\Rule;
use Crisu83\Overseer\Contract\Subject;

class AuthorRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function evaluate(Subject $subject, ResourceContract $resource, array $params)
    {
        if (!$resource instanceof Book) {
            return false;
        }
        return $resource->getAuthorId() === $subject->getSubjectId();
    }
}
