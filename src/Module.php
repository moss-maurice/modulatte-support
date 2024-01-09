<?php

namespace mmaurice\modulatte\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use ReflectionClass;
use mmaurice\modulatte\Support\Controllers\Controller;

abstract class Module
{
    protected $config;
    protected $request;

    public function __construct(array $config = [])
    {
        $this->config = collect($config);
        $this->request = Request::capture();

        $this->import('src/Controllers', '*Controller.php');
        $this->import('src/Models', '*.php');

        $this->navigate();
    }

    public function slug()
    {
        if (preg_match("/^([^\\\\\\/]+)[\\\\\\/]+/imu", get_called_class(), $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function name()
    {
        return $this->config->has('name') ? $this->config->get('name') : $this->slug();
    }

    public function icon()
    {
        return $this->config->has('icon') ? $this->config->get('icon') : 'fa-cube';
    }

    public function id()
    {
        return md5($this->name());
    }

    public function request()
    {
        return $this->request;
    }

    public function tabName()
    {
        return $this->request()->input('tab', 'main');
    }

    public function methodName()
    {
        return $this->request()->input('method', 'index');
    }

    public function path($path = '')
    {
        $reflector = new ReflectionClass($this);

        $modulePath = realpath(dirname($reflector->getFileName()) . '/../');

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

    public function tabs()
    {
        return $this->search('src/Controllers', '*Controller.php')
            ->map(function ($item) {
                if (preg_match("/[\\\\\\/]+([^\\\\\\/]+)Controller\\.php$/imu", $item, $matches)) {
                    $tabName = lcfirst($matches[1]);

                    if ($controllerPath = $this->path('src/Controllers/' . ucfirst($tabName) . 'Controller.php')) {
                        $className = "\\" . $this->slug() . "\\Controllers\\" . ucfirst($tabName) . "Controller";

                        $controller = new $className($this);

                        if ($controller instanceof Controller) {
                            return $controller;
                        }
                    }

                    return null;
                }
            })
            ->filter()
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

    public function tab($tabName = null)
    {
        if (is_null($tabName)) {
            $tabName = $this->tabName();
        }

        $tabs = $this->tabs();

        if ($tabs->has($tabName)) {
            return $tabs->get($tabName);
        }

        return null;
    }

    protected function import($path, $mask)
    {
        return $this->search($path, $mask)
            ->each(function ($file) {
                require_once realpath($file);
            });
    }

    protected function search($path, $mask)
    {
        $path = $this->path($path);

        $mask = DIRECTORY_SEPARATOR . ltrim($mask, '/\\');

        return collect($path ? glob("{$path}{$mask}") : [])
            ->map(function ($file) {
                return realpath($file);
            })
            ->filter(function ($file) {
                return realpath($file) ? true : false;
            });
    }

    protected function navigate()
    {
        if ($this->request()->input('id') === $this->id()) {
            $this->render('main', [
                /*'path' => ModuleHelper::makeUrl(collect($this->request()->all())
                    ->merge([
                        'tab' => $this->tabName(),
                        'method' => $this->methodName(),
                    ])
                    ->filter()
                    ->toArray()),*/]);
        }
    }

    protected function render($template, array $properties = [])
    {
        ob_start();

        include_once realpath(MODX_MANAGER_PATH . 'includes/header.inc.php');

        echo $this->makeView($template, array_merge([
            'modx' => EvolutionCMS(),
            'module' => $this,
        ], $properties));

        include_once realpath(MODX_MANAGER_PATH . 'includes/footer.inc.php');

        $body = ob_get_clean();

        echo $body;

        return;
    }

    public function makeView($template, array $data = [])
    {
        $data = !is_array($data) ? [] : $data;

        View::addNamespace('modulatte', $this->sourcePath('resources/views'));
        View::addNamespace($this->slug(), $this->path('resources/views'));

        if (View::exists("{$this->slug()}::{$template}")) {
            return View::make("{$this->slug()}::{$template}", array_merge($data, [
                'namespace' => $this->slug(),
            ]));
        }

        if (View::exists("modulatte::{$template}")) {
            return View::make("modulatte::{$template}", array_merge($data, [
                'namespace' => 'modulatte',
            ]));
        }

        return View::make("modulatte::notfound", array_merge($data, [
            'namespace' => 'modulatte',
        ]));
    }
}
