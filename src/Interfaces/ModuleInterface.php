<?php

namespace mmaurice\modulatte\Support\Interfaces;

interface ModuleInterface
{
    public function id();

    public function slug();

    public function name();

    public function icon();

    public function position();

    public function request();

    public function tabName();

    public function methodName();

    public function tabs();

    public function tab();

    public function catch();
}
