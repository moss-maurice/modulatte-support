<?php

namespace mmaurice\modulatte\Support\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;
use mmaurice\modulatte\Support\Module;
use mmaurice\modulatte\Support\Traits\Controllers\ChildsExtensionTrait;

abstract class CrudController extends \mmaurice\modulatte\Support\Controllers\Controller implements \mmaurice\modulatte\Support\Interfaces\CrudControllerInterface
{
    use ChildsExtensionTrait;

    protected $model;
    protected $pagination = 25;
    protected $filters = [];
    protected $controlButtons = ['edit', 'delete'];

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

    public function actionBar()
    {
        $actions = parent::actionBar();

        switch ($this->method()) {
            case 'index':
                $actions = $this->actionBarIndex($actions);

                break;
            case 'list':
                $actions = $this->actionBarList($actions);

                break;
            case 'create':
                $actions = $this->actionBarCreate($actions);

                break;
            case 'update':
                $actions = $this->actionBarUpdate($actions);

                break;
        }

        return $actions;
    }

    public function actionBarIndex(Collection $actions)
    {
        $actions->push(ActionElement::build('Добавить', ModuleHelper::makeUrl([
            'tab' => $this->slug,
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
        return $this->actionBarCreate($actions);
    }

    public function controlBar(Model $model)
    {
        return collect($this->controlButtons)
            ->map(function ($item) use ($model) {
                switch ($item) {
                    case 'edit':
                        return ActionElement::build('Изменить', ModuleHelper::makeUrl(array_filter([
                            'tab' => $this->slug(),
                            'method' => 'update',
                            'itemId' => $model->pk(),
                            'redirect' => $this->makeParentRedirect(),
                        ])), 'success btn-sm', 'edit');
                    case 'delete':
                        return ActionElement::build('Удалить', ModuleHelper::makeUrl(array_filter([
                            'tab' => $this->slug(),
                            'method' => 'delete',
                            'itemId' => $model->pk(),
                            'redirect' => $this->makeParentRedirect(),
                        ])), 'danger btn-sm', 'trash-o');
                    default:
                        return null;
                }
            })
            ->filter();
    }

    public function index()
    {
        return $this->list();
    }

    public function list()
    {
        return $this->render('list', [
            'list' => $this->model::filtered($this->filters)
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
                ])),
            'message' => 'Ничего не найдено! Добавить?',
        ]);
    }

    public function create()
    {
        if ($this->module->request()->isMethod('post')) {
            $item = $this->model::create($this->module->request()->post());

            return ModuleHelper::redirect([
                'tab' => $this->slug,
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
            'tab' => $this->slug,
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
            return $this->message('Маршрут с таким идентификатором не существует', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        if ($this->module->request()->isMethod('post')) {
            $item->fill($this->module->request()->post())
                ->save();
        }

        return $this->render('update', [
            'item' => $item,
            'grids' => $this->getChilds($item),
        ]);
    }

    public function delete()
    {
        $redirect = $this->module->request()->input('redirect', ModuleHelper::makeUrl([
            'tab' => $this->slug,
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
            return $this->message('Маршрут с таким идентификатором не существует', collect([
                ActionElement::build('Назад', $redirect, 'secondary', 'angle-left'),
            ]));
        }

        $item->delete();

        return ModuleHelper::redirectUrl($redirect);
    }
}
