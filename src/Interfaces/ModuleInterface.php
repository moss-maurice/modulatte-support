<?php

namespace mmaurice\modulatte\Support\Interfaces;

interface ModuleInterface
{
    public function id();

    public function slug();

    public function name();

    public function icon();

    public function position();

    public function hideTabs();

    public function request();

    public function tabName($default = 'main');

    public function methodName($default = 'index');

    public function itemId($default = null);

    public function filter(array $default = []);

    public function order(array $default = []);

    public function redirect($default = null);

    public function tabs();

    public function tab($tabName);

    public function currentTab();

    public function catch();
}
