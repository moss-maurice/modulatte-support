<?php

namespace mmaurice\modulatte\Support\Components;

use Illuminate\Support\Collection;

class ActionElement
{
    const DEFAULT_TARGET = '#';
    const DEFAULT_STYLE = 'secondary';
    const DEFAULT_ICON = null;

    protected $caption;
    protected $target;
    protected $style;
    protected $icon;
    protected $dropdown;
    protected $props;

    private function __construct($caption, $target = self::DEFAULT_TARGET, $style = self::DEFAULT_STYLE, $icon = self::DEFAULT_ICON, Collection $props = null, Collection $dropdown = null)
    {
        $this->caption = $caption;
        $this->target = $target;
        $this->style = $style;
        $this->icon = $icon;
        $this->dropdown = !is_null($dropdown) ? $dropdown : collect([]);
        $this->props = !is_null($props) ? $props : collect([]);

        return false;
    }

    public static function build($caption, $target = self::DEFAULT_TARGET, $style = self::DEFAULT_STYLE, $icon = self::DEFAULT_ICON, Collection $props = null, Collection $dropdown = null)
    {
        return new static($caption, $target, $style, $icon, $props, $dropdown);
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function getTarget()
    {
        return ($this->target ? $this->target : static::DEFAULT_TARGET);
    }

    public function getStyle()
    {
        return ($this->style ? $this->style : static::DEFAULT_STYLE);
    }

    public function hasIcon()
    {
        return (!is_null($this->icon) ? true : false);
    }

    public function getIcon()
    {
        return ($this->hasIcon() ? "fa fa-{$this->icon}" : static::DEFAULT_ICON);
    }

    public function hasDropdown()
    {
        return ($this->dropdown && $this->dropdown->isNotEmpty() && !empty($this->dropdown) ? true : false);
    }

    public function getDropdown()
    {
        return ($this->hasDropdown() ? $this->dropdown : collect([]));
    }

    public function hasProps()
    {
        return ($this->props && $this->props->isNotEmpty() ? true : false);
    }

    public function getProps()
    {
        return ($this->hasProps() ? $this->props : collect([]));
    }

    public function hasProp($name)
    {
        return ($this->getProps() && $this->getProps()->has($name) ? true : false);
    }

    public function getProp($name)
    {
        return ($this->hasProp($name) ? $this->getProps()->get($name) : null);
    }

    public function getPropsToLine()
    {
        return $this->getProps()->map(function ($item, $key) {
            return " {$key}=\"{$item}\"";
        })
            ->filter()
            ->values()
            ->implode('');
    }
}
