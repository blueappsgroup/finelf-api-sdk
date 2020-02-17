<?php

namespace Finelf\DTO;

use stdClass;

class BaseDTO {
    public function __construct(stdClass $jsonObject) {
        if (!empty($jsonObject)) {
            foreach ($jsonObject as $propertyName => $propertyValue) {
                if (property_exists($this, $propertyName) && !method_exists($this, $propertyName)) {
                    $this->$propertyName = $propertyValue;
                }

                if (method_exists($this, $propertyName)) {
                    $this->$propertyName($propertyValue);
                }
            }
        }
    }
}
