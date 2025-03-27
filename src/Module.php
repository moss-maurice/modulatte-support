<?php

namespace mmaurice\modulatte\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use ReflectionClass;
use mmaurice\modulatte\Support\Controllers\Controller;
use mmaurice\modulatte\Support\Exceptions\ModulatteException;

abstract class Module implements \mmaurice\modulatte\Support\Interfaces\ModuleInterface
{
    protected $request;

    public function __construct()
    {
        $this->request = Request::capture();
    }

    public function slug()
    {
        if (preg_match("/[\\\\\\/]+([^\\\\\\/]+)[\\\\\\/]+Module$/imu", get_called_class(), $matches)) {
            return lcfirst($matches[1]);
        }

        return null;
    }

    public function id()
    {
        return md5($this->name());
    }

    public function position()
    {
        return 9999;
    }

    public function hideTabs()
    {
        return [];
    }

    public function request()
    {
        return $this->request;
    }

    public function tabName($default = null)
    {
        return $this->request()->input('tab', !is_null($default) ? $default : $this->tabs()->filter(function ($item) {
            return in_array($item->slug(), $this->hideTabs()) ? false : true;
        })->first()->slug());
    }

    public function methodName($default = 'index')
    {
        return $this->request()->input('method', $default);
    }

    public function itemId($default = null)
    {
        return $this->request()->input('itemId', $default);
    }

    public function filter(array $default = [])
    {
        return $this->request()->input('filter', $default);
    }

    public function order(array $default = [])
    {
        return $this->request()->input('order', $default);
    }

    public function redirect($default = null)
    {
        return $this->request()->input('redirect', $default);
    }

    public function path($path = '')
    {
        $reflector = new ReflectionClass($this);

        $modulePath = realpath(dirname($reflector->getFileName()) . '/../../');

        return realpath("{$modulePath}/{$path}");
    }

    public function webPath($path = '', array $data = [])
    {
        $path = $this->path($path);

        if ($path) {
            return str_replace("\\", '/', str_replace(realpath(base_path('../')), '', $path)) . (!empty($data) ? '?' . http_build_query($data) : '');
        }

        return $path;
    }

    public function sourcePath($path = '')
    {
        $modulePath = realpath(dirname(__FILE__) . '/../');

        return realpath("{$modulePath}/{$path}");
    }

    public function webSourcePath($path = '', array $data = [])
    {
        $path = $this->sourcePath($path);

        if ($path) {
            return str_replace("\\", '/', str_replace(realpath(base_path('../')), '', $path)) . (!empty($data) ? '?' . http_build_query($data) : '');
        }

        return $path;
    }

    /**
     * Метод определения доступных для модуля табов
     *
     * @return Illuminate\Support\Collection
     */
    public function tabs()
    {
        return $this->search('modules/' . ucfirst($this->slug()) . '/Controllers', '*Controller.php')
            ->map(function ($item) {
                if (preg_match("/[\\\\\\/]+([^\\\\\\/]+)Controller\\.php$/imu", $item, $matches)) {
                    $tabName = lcfirst($matches[1]);

                    if ($controllerPath = $this->path('modules/' . ucfirst($this->slug()) . '/Controllers/' . ucfirst($tabName) . 'Controller.php')) {
                        $className = preg_replace('/^(.+)\\\\' . ucfirst($this->slug()) . '\\\\Module$/imu', '$1', get_called_class()) . "\\" . ucfirst($this->slug()) . "\\Controllers\\" . ucfirst($tabName) . "Controller";

                        $controller = new $className($this);

                        if ($controller instanceof Controller) {
                            return $controller;
                        }
                    }

                    return null;
                }
            })
            ->filter(function ($item) {
                return !is_null($item) ? true : false;
            })
            ->sort(function ($left, $right) {
                return $left->position() <=> $right->position();
            })
            ->values()
            ->map(function ($item) {
                return [
                    'slug' => $item->slug(),
                    'item' => $item,
                ];
            })
            ->pluck('item', 'slug');
    }

    /**
     * Метод получения сущности выбранного таба
     *
     * @param  string $tabName
     *
     * @return mmaurice\modulatte\Support\Interfaces\CrudControllerInterface|null
     */
    public function tab($tabName)
    {
        $tabs = $this->tabs(true);

        if ($tabs->has($tabName)) {
            return $tabs->get($tabName);
        }

        throw new ModulatteException("Tab '{$tabName}' not found");
    }

    /**
     * Метод получения сущности текущей активной вкладки
     *
     * @return mmaurice\modulatte\Support\Interfaces\CrudControllerInterface|null
     */
    public function currentTab()
    {
        $tabName = $this->tabName();

        return $this->tab($tabName);
    }

    /**
     * Метод определения доступных для модели контроллеров
     *
     * @param  string $path
     * @param  string $mask
     *
     * @return Illuminate\Support\Collection
     */
    protected function search($path, $mask)
    {
        $path = $this->path($path);

        $mask = DIRECTORY_SEPARATOR . ltrim($mask, '/\\');

        return collect($path ? glob("{$path}{$mask}") : [])
            ->map(function ($file) {
                return realpath($file);
            })
            ->filter()
            ->values();
    }

    protected function render($template, array $properties = [])
    {
        $content = $this->currentTab()->content();

        ob_start();

        include_once realpath(MODX_MANAGER_PATH . 'includes/header.inc.php');

        echo $this->makeView($template, array_merge([
            'modx' => EvolutionCMS(),
            'module' => $this,
            'tab' => $this->currentTab(),
            'content' => $content,
        ], $properties));

        include_once realpath(MODX_MANAGER_PATH . 'includes/footer.inc.php');

        $body = ob_get_clean();

        echo $body;

        return;
    }

    public function makeView($template, array $data = [])
    {
        $data = !is_array($data) ? [] : $data;

        if ($moduleResourcePath = $this->path("resources/views")) {
            View::addNamespace($this->slug(), $moduleResourcePath);

            if (View::exists("{$this->slug()}::{$template}")) {
                return View::make("{$this->slug()}::{$template}", array_merge($data, [
                    'namespace' => $this->slug(),
                ]));
            }
        }

        if ($basicResourcePath = $this->sourcePath('resources/views')) {
            View::addNamespace('modulatte', $basicResourcePath);

            if (View::exists("modulatte::{$template}")) {
                return View::make("modulatte::{$template}", array_merge($data, [
                    'namespace' => 'modulatte',
                ]));
            }
        }

        return View::make("modulatte::notfound", array_merge($data, [
            'namespace' => 'modulatte',
        ]));
    }

    public function catch()
    {
        if ($this->request->input('id') === $this->id()) {
            $this->render('main');

            return true;
        }

        return false;
    }
}
