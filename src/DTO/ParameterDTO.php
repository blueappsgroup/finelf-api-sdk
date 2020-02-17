<?php

namespace Finelf\DTO;

class ParameterDTO extends BaseDTO {
    public $name;
    public $type;
    public $value;
    public $prefix;
    public $suffix;
    public $slug;

    protected function parameter($parameter) {
        $this->name   = $parameter->name;
        $this->type   = $parameter->type;
        $this->slug   = $parameter->slug;
        $this->value = !empty($parameter->prefix) ? $parameter->prefix.' ' : ''.$this->value.!empty($parameter->suffix) ? ' '.$parameter->suffix : '';
    }
}
