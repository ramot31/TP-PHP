<?php
interface IRepository
{
    public function findAll();
    public function findById($id);
    public function delete($id);
    public function create($params);
}