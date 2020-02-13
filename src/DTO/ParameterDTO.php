<?php

namespace Finelf\DTO;

class ParameterDTO extends BaseDTO {
    public $name;
    public $type;
    public $value;
    public $prefix;
    public $suffix;
    public $slug;

    public function parameter($parameter) {
        $this->name   = $parameter->name;
        $this->type   = $parameter->type;
        //$this->slug   = $parameter->slug;
        //$this->prefix = $parameter->prefix;
        //$this->suffix = $parameter->suffix;
    }
}
