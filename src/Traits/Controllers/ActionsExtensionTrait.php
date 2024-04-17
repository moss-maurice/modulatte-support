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
            ->paginate($this->pagination(), ['*'], 'page', in_array($this->model::getActor(), ['filter', 'order']) ? 1 : $this->module->request()->input('page', 1))
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

    protected function onItem($id)
    {
        return $this->model::find($id);
    }

    protected function onCreate()
    {
        $fields = collect($this->module->request()->post())
            ->filter(function ($item, $key) {
                return in_array($key, $this->model()->itemFields());
            })
            ->map(function ($item, $key) {
                return in_array($item, ['Нет'], true) ? null : trim($item);
            })
            ->toArray();

        return $this->model::create($fields);
    }

    protected function onUpdate(Model $item)
    {
        $fields = collect($this->module->request()->post())
            ->filter(function ($item, $key) {
                return in_array($key, $this->model()->itemFields());
            })
            ->map(function ($item, $key) {
                return in_array($item, ['Нет'], true) ? null : trim($item);
            })
            ->toArray();

        $item->fill($fields)
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
