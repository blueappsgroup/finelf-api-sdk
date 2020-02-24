<?php

namespace Finelf\DTO;

class ParameterDTO extends BaseDTO {
    public $name;
    public $type;
    public $value;
    public $slug;

    private function formatValue($prefix, $suffix, $value, $type) {
        if ($type === 4) { // boolean
            return $value === '1' ? 'Tak' : 'Nie';
        }

        if (!empty($prefix)) {
            $prefix .= ' ';
        }

        if (!empty($suffix)) {
            $value .= ' ';
        }

        return $prefix . $value . $suffix;
    }

    protected function parameter($parameter) {
        $this->name  = $parameter->name;
        $this->type  = $parameter->type;
        $this->slug  = $parameter->slug;
        $this->value = $this->formatValue($parameter->prefix, $parameter->suffix, $this->value, $parameter->type);
    }
}
