<?php

namespace mmaurice\modulatte\Support\Controllers;

use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;
use mmaurice\modulatte\Support\Module;
use mmaurice\modulatte\Support\Traits\Controllers\ActionBarExtensionTrait;
use mmaurice\modulatte\Support\Traits\Controllers\ActionsExtensionTrait;
use mmaurice\modulatte\Support\Traits\Controllers\ChildsExtensionTrait;
use mmaurice\modulatte\Support\Traits\Controllers\ControlBarExtensionTrait;
use mmaurice\modulatte\Support\Traits\Controllers\FilterBarExtensionTrait;
use mmaurice\modulatte\Support\Traits\Controllers\GroupBarExtensionTrait;

abstract class CrudController extends \mmaurice\modulatte\Support\Controllers\Controller implements \mmaurice\modulatte\Support\Interfaces\CrudControllerInterface
{
    use ActionBarExtensionTrait;
    use ActionsExtensionTrait;
    use ChildsExtensionTrait;
    use ControlBarExtensionTrait;
    use FilterBarExtensionTrait;
    use GroupBarExtensionTrait;

    protected $model;
    protected $pagination = 25;
    protected $filters = [];

    public function __construct(Module $module)
    {
        parent::__construct($module);

        $this->childs();
    }

    public function model()
    {
        return new $this->model;
    }

    public function pagination()
    {
        return $this->pagination;
    }

    public function setPagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function withFilter(array $filter)
    {
        $this->filters = $filter;

        return $this;
    }

    public function index()
    {
        return $this->list();
    }

    public function list()
    {
        return $this->render('list', [
            'list' => $this->onList(),
        ]);
    }

    public function create()
    {
        if ($this->module->request()->isMethod('post')) {
            $item = $this->onCreate();

            if (!($item instanceof $this->model)) {
                return $item;
            }

            return ModuleHelper::redirect([
                'tab' => $this->slug(),
                'method' => 'update',
                'itemId' => $item->pk(),
                'redirect' => $this->module->request()->input('redirect'),
            ]);
        }

        return $this->render('create', [
            'item' => $this->model(),
            'redirect' => $this->makeParentRedirect(),
        ]);
    }

    public function update()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug(),
        ]));

        $itemId = $this->module->request()->input('itemId');

        if (is_null($itemId)) {
            return $this->message('Попытка запросить не существующую страницу. Пожалуйста, убедитесь, что вы верно передали аргументы запроса!', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $item = $this->onItem($itemId);

        if (!($item instanceof $this->model)) {
            return $item;
        }

        if ($this->module->request()->isMethod('post')) {
            $item = $this->onUpdate($item);

            if (!($item instanceof $this->model)) {
                return $item;
            }

            return ModuleHelper::redirectUrl($this->module->request()->getRequestUri());
        }

        return $this->render('update', [
            'item' => $item,
            'grids' => $this->getChilds($item),
        ]);
    }

    public function clone()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug(),
        ]));

        $itemId = $this->module->request()->input('itemId');

        if (is_null($itemId)) {
            return $this->message('Попытка запросить не существующую страницу. Пожалуйста, убедитесь, что вы верно передали аргументы запроса!', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $item = $this->model::where($this->model::pkField(), $itemId)
            ->first();

        if (!$item) {
            return $this->message('Запись с таким идентификатором не существует', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $this->onClone($item);

        return ModuleHelper::redirectUrl($redirect);
    }

    public function delete()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug(),
            'method' => 'list',
        ]));

        $itemId = $this->module->request()->input('itemId');

        if (is_null($itemId)) {
            return $this->message('Попытка запросить не существующую страницу. Пожалуйста, убедитесь, что вы верно передали аргументы запроса!', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $item = $this->model::where($this->model::pkField(), $itemId)
            ->first();

        if (!$item) {
            return $this->message('Запись с таким идентификатором не существует', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $this->onDelete($item);

        return ModuleHelper::redirectUrl($redirect);
    }
}
