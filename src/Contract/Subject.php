<?php namespace Crisu83\Overseer\Contract;

interface Subject
{

    /**
     * @return string
     */
    public function getSubjectId();


    /**
     * @return string
     */
    public function getSubjectName();
}
