<?php

namespace Hubertnnn\LaravelNova\Fields\DynamicSelect;

use Hubertnnn\LaravelNova\Fields\DynamicSelect\Traits\DependsOnAnotherField;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\Traits\HasDynamicOptions;
use Laravel\Nova\Fields\Field;

class DynamicSelect extends Field
{
    use HasDynamicOptions;
    use DependsOnAnotherField;
    protected $placeholder = null;
    protected $selectLabel = null;
    protected $deselectLabel = null;
    protected $selectedLabel = null;

    public $component = 'dynamic-select';

    public function resolve($resource, $attribute = null)
    {
        $this->extractDependentValues($resource);

        return parent::resolve($resource, $attribute);
    }

    public function meta()
    {
        $this->meta = parent::meta();
        return array_merge([
            'options' => $this->getOptions($this->dependentValues),
            'dependsOn' => $this->getDependsOn(),
            'dependValues' => $this->dependentValues,
            'placeholder' => $this->placeholder,
            'selectLabel' => $this->selectLabel,
            'deselectLabel' => $this->deselectLabel,
            'selectedLabel' => $this->selectedLabel
        ], $this->meta);
    }
}
