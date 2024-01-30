<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;
use mmaurice\modulatte\Support\Interfaces\CrudControllerInterface;

trait ChildsExtensionTrait
{
    protected $childs = [];
    protected $parentController;
    protected $parentItem;
    protected $filterForm = true;
    protected $orderForm = true;
    protected $listActionBar = false;

    public function childs()
    {
        # do nothing!
    }

    public function setParent(CrudControllerInterface $controller)
    {
        $this->parentController = $controller;

        return $this;
    }

    public function setItem(Model $item)
    {
        $this->parentItem = $item;

        return $this;
    }

    public function withoutFilterForm()
    {
        $this->filterForm = false;

        return $this;
    }

    public function withFilterForm()
    {
        $this->filterForm = true;

        return $this;
    }

    public function withoutOrderForm()
    {
        $this->orderForm = false;

        return $this;
    }

    public function withOrderForm()
    {
        $this->orderForm = true;

        return $this;
    }

    public function withoutListActionBar()
    {
        $this->listActionBar = false;

        return $this;
    }

    public function withListActionBar()
    {
        $this->listActionBar = true;

        return $this;
    }

    public function parentController()
    {
        return $this->parentController ? $this->parentController : $this;
    }

    public function parentItem()
    {
        return $this->parentItem;
    }

    public function filterForm()
    {
        return $this->filterForm;
    }

    public function orderForm()
    {
        return $this->orderForm;
    }

    public function listActionBar()
    {
        return $this->listActionBar;
    }

    public function makeParentRedirect(array $properties = [])
    {
        $link = null;

        if (!is_null($this->parentController())) {
            $link = ModuleHelper::makeUrl(array_merge([
                'a' => $this->module->request()->input('a'),
                'id' => $this->module->request()->input('id'),
                'tab' => $this->parentController()->slug(),
                'method' => $this->parentController()->method(),
                'itemId' => !is_null($this->parentItem()) ? $this->parentItem()->id : null,
                'filter' => $this->module->filter(),
                'order' => $this->module->order(),
                'page' => $this->module->request()->input('page'),
            ], $properties));
        }

        return $link;
    }

    protected function getChilds(Model $item)
    {
        return collect($this->childs)
            ->map(function ($child) use ($item) {
                return $this->module
                    ->tab($child[0])
                    ->setParent($this)
                    ->setItem($item)
                    ->withoutFilterForm()
                    ->withoutOrderForm()
                    ->withListActionBar()
                    ->withFilter([
                        $child[1] => $item->{$child[2]},
                    ]);
            });
    }

    protected function addChild($className, $pkId, $id)
    {
        $this->childs[] = [
            $className,
            $pkId,
            $id,
        ];
    }
}
