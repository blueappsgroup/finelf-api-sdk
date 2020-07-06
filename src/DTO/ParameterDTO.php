<?php

namespace Finelf_Api_Sdk\DTO;

use Finelf_Api_Sdk\Formatters\ParamFormatter;

class ParameterDTO extends BaseDTO {
    public $name;
    public $type;
    public $value;
    public $slug;
    public $description;

    protected function parameter( object $parameter ) {
        $prefix      = $parameter->prefix === null ? '' : $parameter->prefix;
        $suffix      = $parameter->suffix === null ? '' : $parameter->suffix;
        $this->name  = $parameter->name;
        $this->type  = $parameter->type;
        $this->slug  = $parameter->slug;
        $this->value = ParamFormatter::formatValue( $prefix, $suffix, $this->value, $parameter->type );
    }
}
