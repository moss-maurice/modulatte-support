<?php

namespace mmaurice\modulatte\Support\Traits\Controllers;

use mmaurice\modulatte\Support\Components\ActionElement;

trait FilterBarExtensionTrait
{
    public function filterBarFields()
    {
        return collect($this->model()->filterFields());
    }

    public function filterBarButtons()
    {
        return collect([
            ActionElement::build('Фильтр', null, 'success w100', 'search', collect([
                'id' => 'filter-run',
                'name' => 'filter-run',
            ]))
        ]);
    }
}
