<?php

namespace mmaurice\modulatte\Support\Traits\Model;

use Illuminate\Http\Request;
use mmaurice\modulatte\Support\Helpers\ModuleHelper;

trait ModuleExtensionTrait
{
    public static function pkField()
    {
        return 'id';
    }

    public function fieldsNames()
    {
        return [];
    }

    public function listFields()
    {
        return [];
    }

    public function prependListFields()
    {
        return ['id'];
    }

    public function appendListFields()
    {
        return [];
    }

    public function itemFields()
    {
        return [];
    }

    public function prependItemFields()
    {
        return ['id'];
    }

    public function appendItemFields()
    {
        return ['created_at', 'updated_at'];
    }

    public function filterFields()
    {
        return [];
    }

    public function orderFields()
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

    public function pk()
    {
        $pkFieldName = static::pkField();

        return $this->{$pkFieldName};
    }

    public static function getActor()
    {
        return Request::capture()->input('actor');
    }

    public function scopeFiltered($query, array $fields = [])
    {
        $rules = collect($this->filterRules());

        collect($this->filterFields())
            ->merge(array_keys($fields))
            ->each(function ($item) use ($rules, $fields, &$query) {
                if ($rules->isNotEmpty() and $rules->has($item)) {
                    $callback = $rules->get($item);

                    $query = call_user_func_array($callback, [$query]);
                } else {
                    $field = $this->requestedFieldValue("filter.{$item}", array_key_exists($item, $fields) ? $fields[$item] : null);

                    $query->when(!is_null($field) and !empty($field), function ($query) use ($item, $field) {
                        $query->where($item, $field);
                    });
                }
            });

        return $query;
    }

    public function scopeOrdered($query, array $fields = [])
    {
        $orders = $this->mappedOrderFields();

        if ($orders->isNotEmpty()) {
            $orders->each(function ($item, $key) use (&$query) {
                if (in_array($item, ['asc', 'desc'])) {
                    $query->orderBy($this->unmappedField($key), $item);
                }
            });
        }

        return $query;
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
            'template' => 'partials.builder.table.fields.head.text',
            'attributes' => [
                'name' => $name,
                'title' => $this->mappedFieldName($name),
                'class' => $this->mappedListFieldClass($name),
                'order' => $this->mappedOrderField($name),
            ],
        ]);
    }

    public function getIdListHeadField()
    {
        return collect([
            'template' => 'partials.builder.table.fields.head.text',
            'attributes' => [
                'name' => 'id',
                'title' => '#',
                'class' => $this->mappedListFieldClass('id', 'text-right'),
                'order' => $this->mappedOrderField('id'),
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
            'template' => 'partials.builder.table.fields.body.text',
            'attributes' => [
                'name' => $name,
                'value' => $this->mappedFieldValue($this->$name),
                'class' => $this->mappedListFieldClass($name),
            ],
        ]);
    }

    public function getIdListField()
    {
        return collect([
            'template' => 'partials.builder.table.fields.body.id',
            'attributes' => [
                'name' => 'id',
                'value' => $this->mappedFieldValue($this->id),
                'class' => $this->mappedListFieldClass('id', 'text-right'),
            ],
        ]);
    }

    public function getIdEditorField()
    {
        return collect([
            'template' => 'partials.builder.form.fields.id',
            'attributes' => [
                'name' => 'id',
                'title' => $this->mappedFieldName('id'),
                'value' => $this->mappedFieldValue($this->id),
                'comment' => '',
            ],
        ]);
    }

    public function getCreatedAtEditorField()
    {
        return collect([
            'template' => 'partials.builder.form.fields.date',
            'attributes' => [
                'name' => 'created_at',
                'title' => $this->mappedFieldName('created_at'),
                'class' => $this->mappedListFieldClass('created_at'),
                'value' => $this->mappedFieldValue($this->created_at),
                'comment' => '',
            ],
        ]);
    }

    public function getUpdatedAtEditorField()
    {
        return collect([
            'template' => 'partials.builder.form.fields.date',
            'attributes' => [
                'name' => 'updated_at',
                'title' => $this->mappedFieldName('updated_at'),
                'class' => $this->mappedListFieldClass('updated_at'),
                'value' => $this->mappedFieldValue($this->updated_at),
                'comment' => '',
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
            'attributes' => [
                'name' => $name,
                'title' => $this->mappedFieldName($name),
                'value' => $this->mappedFieldValue($this->$name, ''),
                'class' => $this->mappedEditorFieldClass($name),
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
            'attributes' => [
                'name' => $name,
                'title' => $this->mappedFieldName($name),
                'class' => $this->mappedFilterFieldClass($name),
                'value' => $this->mappedFilterFieldValue($name),
                'comment' => '',
            ],
        ]);
    }

    public function mappedFieldName($name, $default = '')
    {
        return $this->mappedFieldsNames()->has($name) ? $this->mappedFieldsNames()->get($name) : $default;
    }

    public function mappedListField($name, $default = '')
    {
        return $this->mappedListFields()->has($name) ? $this->mappedListFields()->get($name) : $default;
    }

    public function mappedEditorField($name, $default = '')
    {
        return $this->mappedEditorFields()->has($name) ? $this->mappedEditorFields()->get($name) : $default;
    }

    public function mappedFilterField($name, $default = '')
    {
        return $this->mappedFilterFields()->has($name) ? $this->mappedFilterFields()->get($name) : $default;
    }

    public function mappedOrderField($name, $default = 'none')
    {
        return $this->mappedOrderFields()->has($name) ? $this->mappedOrderFields()->get($name) : $default;
    }

    public function mappedListFieldClass($name, $default = '')
    {
        return $this->mappedListFieldsClasses()->has($name) ? $this->mappedListFieldsClasses()->get($name) : $default;
    }

    public function mappedEditorFieldClass($name, $default = '')
    {
        return $this->mappedEditorFieldsClasses()->has($name) ? $this->mappedEditorFieldsClasses()->get($name) : $default;
    }

    public function mappedFilterFieldClass($name, $default = '')
    {
        return $this->mappedFilterFieldsClasses()->has($name) ? $this->mappedFilterFieldsClasses()->get($name) : $default;
    }

    public function mappedFieldValue($value, $default = '—')
    {
        return ((!is_null($value) && ($value !== '')) ? $value : $default);
    }

    public function mappedFilterFieldValue($name, $default = null)
    {
        return $this->requestedFieldValue("filter.{$name}", $default);
    }

    public function requestedFieldValue($name, $default = null)
    {
        return Request::capture()->input($name, $default);
    }

    public function mappedFieldsNames()
    {
        return collect($this->fieldsNames());
    }

    public function mappedListFields()
    {
        return collect($this->prependListFields())
            ->merge($this->listFields())
            ->merge($this->appendListFields())
            ->map(function ($name) {
                return $this->mappedField($name);
            });
    }

    public function mappedEditorFields()
    {
        return collect($this->prependItemFields())
            ->merge($this->itemFields())
            ->merge($this->appendItemFields())
            ->map(function ($name) {
                return $this->mappedField($name);
            });
    }

    public function mappedFilterFields()
    {
        return collect($this->filterFields())->map(function ($name) {
            return $this->mappedField($name);
        });
    }

    public function mappedOrderFields()
    {
        $fields = collect($this->requestedFieldValue("order"))
            ->filter();

        if ($fields->isEmpty()) {
            $fields = collect();

            foreach ($this->orderFields() as $key => $item) {
                if (is_integer($key)) {
                    $fields->put($this->mappedField($item), 'asc');
                } else {
                    $fields->put($this->mappedField($key), $item);
                }
            }
        }

        return $fields;
    }

    public function mappedListFieldsClasses()
    {
        return collect($this->listFieldsClasses());
    }

    public function mappedEditorFieldsClasses()
    {
        return collect($this->itemFieldsClasses());
    }

    public function mappedFilterFieldsClasses()
    {
        return collect($this->filterFieldsClasses());
    }

    public function mappedField($name)
    {
        return ModuleHelper::underScoreToCamelCase($name);
    }

    public function unmappedField($name)
    {
        return ModuleHelper::camelCaseToUnderScore($name);
    }
}
