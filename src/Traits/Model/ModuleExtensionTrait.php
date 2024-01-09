<?php

namespace mmaurice\modulatte\Support\Traits\Model;

use Illuminate\Http\Request;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait ModuleExtensionTrait
{
    public function fieldsNames()
    {
        return [];
    }

    public function listFields()
    {
        return [];
    }

    public function itemFields()
    {
        return [];
    }

    public function filterFields()
    {
        return [];
    }

    public function listFieldsClasses()
    {
        return [];
    }

    public function itemFieldsClasses()
    {
        return [];
    }

    public function filterFieldsClasses()
    {
        return [];
    }

    public function filterRules()
    {
        return [];
    }

    public function scopeFiltered($query)
    {
        $query = $query->published();

        $rules = collect($this->filterRules());

        collect($this->filterFields())
            ->each(function ($item) use ($rules, &$query) {

                if ($rules->isNotEmpty() and $rules->has($item)) {
                    $callback = $rules->get($item);

                    $query = call_user_func_array($callback, [$query]);
                } else {
                    $field = Request::capture()
                        ->input($item);

                    $query->when(!is_null($field) and !empty($field), function ($query) use ($item, $field) {
                        $query->where($item, $field);
                    });
                }
            });

        return $query;
    }

    public function mappedListFields()
    {
        return collect($this->listFields())->map(function ($name) {
            return $this->mappedField($name);
        });
    }

    public function mappedEditorFields()
    {
        return collect($this->itemFields())->map(function ($name) {
            return $this->mappedField($name);
        });
    }

    public function mappedFilterFields()
    {
        return collect($this->filterFields())->map(function ($name) {
            return $this->mappedField($name);
        });
    }

    public function mappedField($name)
    {
        return ModuleHelper::underScoreToCamelCase($name);
    }

    protected function registered()
    {
        return [
            'listHeadField',
            'listField',
            'editorField',
        ];
    }

    public function __call($name, $arguments)
    {
        $registered = collect($this->registered())
            ->map(function ($item) {
                return ucfirst($item);
            })
            ->implode('|');

        if (preg_match('/^(get)(.+)(' . $registered . ')$/imu', $name, $matches)) {
            $method = "{$matches[1]}{$matches[3]}";

            if (method_exists($this, $method)) {
                return call_user_func_array([$this, $method], [$matches[2]]);
            }
        }

        return parent::__call($name, $arguments);
    }

    public function getListHeadField($name)
    {
        $name = ModuleHelper::camelCaseToUnderScore($name);

        $methodName = 'get' . ucfirst($name) . 'ListHeadField';

        if (method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName]);
        }

        return collect([
            'template' => 'partials.builder.table.fields.head',
            'attributes' => [
                'name' => $name,
                'title' => (collect($this->fieldsNames())->has($name) ? collect($this->fieldsNames())->get($name) : $name),
                'class' => (collect($this->listFieldsClasses())->has($name) ? collect($this->listFieldsClasses())->get($name) : ''),
            ],
        ]);
    }

    public function getListField($name)
    {
        $name = ModuleHelper::camelCaseToUnderScore($name);

        $methodName = 'get' . ModuleHelper::underScoreToCamelCase($name, true) . 'ListField';

        if (method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName]);
        }

        return collect([
            'template' => 'partials.builder.table.fields.body',
            'attributes' => [
                'name' => $name,
                'value' => ((!is_null($this->$name) && ($this->$name !== '')) ? $this->$name : '—'),
                'class' => (collect($this->listFieldsClasses())->has($name) ? collect($this->listFieldsClasses())->get($name) : ''),
            ],
        ]);
    }

    public function getEditorField($name)
    {
        $name = ModuleHelper::camelCaseToUnderScore($name);

        $methodName = 'get' . ModuleHelper::underScoreToCamelCase($name, true) . 'EditorField';

        if (method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName]);
        }

        return collect([
            'template' => 'partials.builder.form.fields.inputText',
            'fields' => [
                'name' => $name,
                'title' => (collect($this->fieldsNames())->has($name) ? collect($this->fieldsNames())->get($name) : $name),
                'value' => ($this->$name ? $this->$name : ''),
                'class' => (collect($this->itemFieldsClasses())->has($name) ? collect($this->itemFieldsClasses())->get($name) : ''),
                'comment' => '',
            ],
        ]);
    }

    public function getFilterField($name)
    {
        $methodName = 'get' . ModuleHelper::underScoreToCamelCase($name, true) . 'FilterField';

        if (method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName]);
        }

        return collect([
            'template' => 'partials.builder.filter.fields.inputText',
            'fields' => [
                'name' => $name,
                'title' => (collect($this->fieldsNames())->has($name) ? collect($this->fieldsNames())->get($name) : $name),
                'class' => (collect($this->filterFieldsClasses())->has($name) ? collect($this->filterFieldsClasses())->get($name) : ''),
                'value' => '',
                'comment' => '',
            ],
        ]);
    }
}
