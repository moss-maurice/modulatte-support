<?php

namespace mmaurice\modulatte\Support\Interfaces;

use Illuminate\Support\Collection;
use mmaurice\modulatte\Support\Module;

interface ControllerInterface
{
    public function __construct(Module $module);

    public function position();

    public function slug();

    public function name();

    public function method();

    public function hideTab();

    public function actionBar(Collection $actions = null);

    public function index();
}
