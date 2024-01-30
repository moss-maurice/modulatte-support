<?php

namespace mmaurice\modulatte\Support\Controllers;

use Exception;
use Illuminate\Support\Collection;
use mmaurice\modulatte\Support\Components\ActionElement;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;
use mmaurice\modulatte\Support\Module;

class Controller implements \mmaurice\modulatte\Support\Interfaces\ControllerInterface
{
    const MESSAGE_PRIMARY = 'primary';
    const MESSAGE_SECONDARY = 'secondary';
    const MESSAGE_SUCCESS = 'success';
    const MESSAGE_DANGER = 'danger';
    const MESSAGE_WARNING = 'warning';
    const MESSAGE_INFO = 'info';
    const MESSAGE_LIGHT = 'light';
    const MESSAGE_DARK = 'dark';

    protected $module;

    protected $position = 9999;
    protected $slug;
    protected $name;
    protected $methodName;

    public function __construct(Module $module)
    {
        $this->module = $module;

        $this->slug = $this->setupSlug();
        $this->name = $this->setupName();
    }

    public function __invoke()
    {
        return $this->execute();
    }

    public function __sotString()
    {
        return $this->content();
    }

    public function position()
    {
        return $this->position;
    }

    public function slug()
    {
        return $this->slug;
    }

    public function name()
    {
        return $this->name;
    }

    public function method()
    {
        return is_null($this->methodName) ? $this->module->methodName() : $this->methodName;
    }

    protected function setupSlug()
    {
        if (is_null($this->slug) or empty($this->slug)) {
            if (preg_match("/\\\\([^\\\\]+)Tab$/imu", get_called_class(), $matches)) {
                return lcfirst($matches[1]);
            }
        }

        return $this->slug;
    }

    protected function setupName()
    {
        if (is_null($this->name) or empty($this->name)) {
            return ucfirst($this->slug) . " Tab";
        }

        return $this->name;
    }

    public function actionBar(Collection $actions = null)
    {
        return !is_null($actions) ? $actions : collect([]);
    }

    public function index()
    {
        return $this->render('index');
    }

    public function message($message, Collection $buttons = null, $messageType = self::MESSAGE_DANGER)
    {
        return collect([
            'template' => 'message',
            'data' => [
                'buttons' => !is_null($buttons) ? $buttons : collect([]),
                'message' => $message,
                'messageType' => $messageType,
            ],
        ]);
    }

    protected function render($template, array $data = [])
    {
        return collect([
            'template' => $template,
            'data' => $data,
        ]);
    }

    public function execute($method = null)
    {
        try {
            $this->methodName = !is_null($method) ? $method : null;

            $method = $this->method();

            if (!method_exists($this, $method)) {
                throw new Exception("Запрошенный метод '{$method}' не найден");
            }

            return call_user_func([$this, $method]);
        } catch (Exception $exception) {
            return $this->message($exception->getMessage(), collect([
                ActionElement::build('Назад', ModuleHelper::makeUrl([
                    'tab' => $this->slug,
                ]), 'secondary', 'angle-left'),
            ]));
        }
    }

    public function content($method = null)
    {
        $tabResource = $this->execute($method);

        $blade = "tab.{$tabResource->get('template')}";

        $templateName = str_replace('.', '/', $tabResource->get('template'));

        if ($this->module->path("resources/views/{$this->module->slug()}/{$this->slug()}/{$templateName}.blade.php")) {
            $blade = $tabResource->get('template');
        }

        $data = array_merge($tabResource->get('data', []), [
            'modx' => EvolutionCMS(),
            'module' => $this->module,
            'tab' => $this,
        ]);

        return $this->module->makeView($blade, $data);
    }
}
