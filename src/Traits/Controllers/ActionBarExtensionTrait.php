<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use Illuminate\Support\Collection;
use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait ActionBarExtensionTrait
{
    public function actionBar()
    {
        $actions = parent::actionBar();

        $methodName = "actionBar" . ucfirst($this->method());

        if (method_exists($this, $methodName)) {
            return call_user_func_array([$this, $methodName], [$actions]);
        }

        return $actions;
    }

    public function actionBarIndex(Collection $actions)
    {
        $actions->push(ActionElement::build('Добавить', ModuleHelper::makeUrl([
            'tab' => $this->slug(),
            'method' => 'create',
            'redirect' => $this->makeParentRedirect(),
        ]), 'success', 'plus'));

        return $actions;
    }

    public function actionBarList(Collection $actions)
    {
        return $this->actionBarIndex($actions);
    }

    public function actionBarCreate(Collection $actions)
    {
        $actions->push(ActionElement::build('Сохранить', 'javascript:;', 'success', null, collect([
            'onclick' => "document.getElementById('{$this->module->slug()}').submit(); return false;",
        ])));

        $actions->push(ActionElement::build('Назад', $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->module->tabName(),
            'method' => $this->module->methodName(),
            'itemId' => $this->module->itemId(),
            'filter' => $this->module->filter(),
            'order' => $this->module->order(),
        ])), 'secondary'));

        return $actions;
    }

    public function actionBarUpdate(Collection $actions)
    {
        $actions->push(ActionElement::build('Сохранить', 'javascript:;', 'success', null, collect([
            'onclick' => "document.getElementById('{$this->module->slug()}').submit(); return false;",
        ])));

        $actions->push(ActionElement::build('Назад', $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->module->tabName(),
            'method' => $this->module->methodName(),
            'itemId' => $this->module->itemId(),
            'filter' => $this->module->filter(),
            'order' => $this->module->order(),
        ])), 'secondary'));

        return $actions;
    }
}
