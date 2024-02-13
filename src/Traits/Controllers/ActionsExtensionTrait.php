<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait ActionsExtensionTrait
{
    protected function onList()
    {
        return $this->model::filtered($this->filters)
            ->ordered()
            ->paginate($this->pagination())
            //->withQueryString()
            ->withPath(ModuleHelper::makeUrl([
                'tab' => $this->module->tabName(),
                'method' => $this->module->methodName(),
                'itemId' => $this->module->itemId(),
                'filter' => $this->module->filter(),
                'order' => $this->module->order(),
                'page' => $this->module->request()->input('page'),
            ]));
    }

    protected function onCreate()
    {
        return $this->model::create($this->module->request()->post());
    }

    protected function onUpdate(Model $item)
    {
        $item->fill($this->module->request()->post())
            ->save();

        return $item;
    }

    protected function onClone(Model $item)
    {
        $newItem = $item->replicate();

        $newItem->save();

        return $newItem;
    }

    protected function onDelete(Model $item)
    {
        $item->delete();

        return null;
    }

    protected function onGroupClone()
    {
        $items = $this->model::whereIn($this->model::pkField(), $this->module->request()->input('group', []))
            ->get();

        if ($items and $items->isNotEmpty()) {
            foreach ($items as $item) {
                $this->onClone($item);
            }
        }
    }

    protected function onGroupDelete()
    {
        $items = $this->model::whereIn($this->model::pkField(), $this->module->request()->input('group', []))
            ->get();

        if ($items and $items->isNotEmpty()) {
            foreach ($items as $item) {
                $this->onDelete($item);
            }
        }
    }
}
