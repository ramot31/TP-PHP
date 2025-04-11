<?php
include_once 'autoloader.php';

class SectionRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('section');
    }
}