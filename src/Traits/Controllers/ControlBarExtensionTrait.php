<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait ControlBarExtensionTrait
{
    protected $controlButtons = ['edit', 'delete'];
    protected $controlBarCompact = false;

    public function isControlBarCompact()
    {
        return $this->controlBarCompact;
    }

    public function controlBar(Model $model)
    {
        return collect($this->controlButtons)
            ->map(function ($item) use ($model) {
                $methodName = "controlBar" . ucfirst($item);

                if (method_exists($this, $methodName)) {
                    return call_user_func_array([$this, $methodName], [$model]);
                }

                return null;
            })
            ->filter();
    }

    public function controlBarEdit(Model $model)
    {
        return ActionElement::build('Изменить', ModuleHelper::makeUrl(array_filter([
            'tab' => $this->slug(),
            'method' => 'update',
            'itemId' => $model->pk(),
            'redirect' => $this->makeParentRedirect(),
        ])), 'success btn-sm', 'edit');
    }

    public function controlBarDelete(Model $model)
    {
        return ActionElement::build('Удалить', ModuleHelper::makeUrl(array_filter([
            'tab' => $this->slug(),
            'method' => 'delete',
            'itemId' => $model->pk(),
            'redirect' => $this->makeParentRedirect(),
        ])), 'danger btn-sm', 'trash-o');
    }

    public function controlBarClone(Model $model)
    {
        return ActionElement::build('Клонировать', ModuleHelper::makeUrl(array_filter([
            'tab' => $this->slug(),
            'method' => 'clone',
            'itemId' => $model->pk(),
            'redirect' => $this->makeParentRedirect(),
        ])), 'primary btn-sm', 'fas fa-clone');
    }
}
