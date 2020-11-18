<?php

namespace Finelf_Api_Sdk\DTO;

class TabDTO extends BaseDTO {
    public $id;
    public $name;
    public $parameters;

    protected function tabsParameters($tabsParameters) {
        if ( ! empty($tabsParameters)) {
            foreach ($tabsParameters as $tabsParameter) {
                $this->parameters[$tabsParameter->parameterId] = $tabsParameter->parameter->slug;
            }
        }
    }
}
