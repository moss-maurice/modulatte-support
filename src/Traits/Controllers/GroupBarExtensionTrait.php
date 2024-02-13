<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait GroupBarExtensionTrait
{
    protected $groupBar = ['delete'];

    public function groupBar()
    {
        return collect($this->groupBar)
            ->map(function ($item) {
                $methodName = "groupBar" . ucfirst($item);

                if (method_exists($this, $methodName)) {
                    return call_user_func_array([$this, $methodName], []);
                }

                return null;
            })
            ->filter();
    }

    public function groupBarDelete()
    {
        return ActionElement::build('Удалить', ModuleHelper::makeUrl(array_filter([
            'tab' => $this->slug(),
            'method' => 'groupDelete',
            'redirect' => $this->makeParentRedirect(),
        ])), 'danger btn-sm', 'trash-o', collect([
            'name' => 'groupDelete',
        ]));
    }

    public function groupBarClone()
    {
        return ActionElement::build('Клонировать', ModuleHelper::makeUrl(array_filter([
            'tab' => $this->slug(),
            'method' => 'groupClone',
            'redirect' => $this->makeParentRedirect(),
        ])), 'primary btn-sm', 'fas fa-clone', collect([
            'name' => 'groupClone',
        ]));
    }

    public function groupClone()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug,
        ]));

        $this->onGroupClone();

        return ModuleHelper::redirectUrl($redirect);
    }

    public function groupDelete()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug,
        ]));

        $this->onGroupDelete();

        return ModuleHelper::redirectUrl($redirect);
    }
}
