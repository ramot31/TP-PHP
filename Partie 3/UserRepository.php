<?php
include_once 'Repository.php';

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('User');
    }
}