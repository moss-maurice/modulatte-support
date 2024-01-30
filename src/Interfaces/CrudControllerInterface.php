<?php

namespace mmaurice\modulatte\Support\Interfaces;

interface CrudControllerInterface
{
    public function model();

    public function pagination();

    public function withFilter(array $filter);

    public function list();

    public function create();

    public function update();

    public function delete();
}
