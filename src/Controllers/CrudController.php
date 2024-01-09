<?php

namespace mmaurice\modulatte\Support\Controllers;

use Illuminate\Support\Collection;
use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

abstract class CrudController extends \mmaurice\modulatte\Support\Controllers\Controller
{
    protected $model;

    public function model()
    {
        return new $this->model;
    }

    public function actionBar(Collection $actions = null)
    {
        if (in_array($this->module->methodName(), ['index', 'list'])) {
            $actions = collect([
                ActionElement::build('Добавить', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                    'method' => 'create',
                ]), 'success', 'plus'),
            ]);
        }

        if (in_array($this->module->methodName(), ['create', 'update'])) {
            $actions = collect([
                ActionElement::build('Сохранить', 'javascript:;', 'success', null, collect([
                    'onclick' => "document.getElementById('{$this->module->slug()}').submit(); return false;",
                ])),
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary'),
            ]);
        }

        return parent::actionBar($actions);
    }

    public function index()
    {
        return $this->list();
    }

    public function list()
    {
        return $this->render('list', [
            'list' => $this->model::filtered()
                ->paginate(25)
                ->withQueryString()
                ->withPath(ModuleHelper::makeUrl([
                    'tab' => $this->slug, //url для пагинации
                ])),
            'message' => 'Пока ничего добавлено! Добавить?',
        ]);
    }

    public function create()
    {
        if ($this->module->request()->isMethod('post')) {
            $item = $this->model::create($this->module->request()->post());

            return ModuleHelper::redirectUrl([
                'tab' => $this->slug,
                'method' => 'update',
                'itemId' => $item->id,
            ]);
        }

        return $this->render('create', [
            'item' => $this->model(),
        ]);
    }

    public function update()
    {
        $itemId = $this->module->request()->input('itemId');

        if (is_null($itemId)) {
            return $this->message('Попытка запросить не существующую страницу. Пожалуйста, убедитесь, что вы верно передали аргументы запроса!', collect([
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary', 'angle-left'),
            ]));
        }

        $item = $this->model::find($itemId);

        if (!$item) {
            return $this->message('Маршрут с таким идентификатором не существует', collect([
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary', 'angle-left'),
            ]));
        }

        if ($this->module->request()->isMethod('post')) {
            $item->fill($this->module->request()->post())
                ->save();
        }

        return $this->render('update', [
            'item' => $item,
        ]);
    }

    public function delete()
    {
        $itemId = $this->module->request()->input('itemId');

        if (is_null($itemId)) {
            return $this->message('Попытка запросить не существующую страницу. Пожалуйста, убедитесь, что вы верно передали аргументы запроса!', collect([
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary', 'angle-left'),
            ]));
        }

        $item = $this->model::find($itemId);

        if (!$item) {
            return $this->message('Маршрут с таким идентификатором не существует', collect([
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary', 'angle-left'),
            ]));
        }

        $item->delete();

        return ModuleHelper::redirectUrl([
            'tab' => $this->slug,
        ]);
    }
}
