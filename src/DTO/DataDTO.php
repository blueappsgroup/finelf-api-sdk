<?php

namespace Finelf_Api_Sdk\DTO;

class DataDTO extends BaseDTO {
    public $name;
    public $value;
    public $slug;

    protected function data( object $data ) {
        $this->name  = $data->name;
        $this->slug  = $data->slug;
    }
}
