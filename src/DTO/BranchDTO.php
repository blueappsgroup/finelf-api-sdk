<?php

namespace Finelf_Api_Sdk\DTO;

class BranchDTO extends BaseDTO {
    public $id;
    public $name;
    public $logo;
    public $entities;

    protected function entities($entities) {
        if ( ! empty($entities)) {
            foreach ($entities as $entity) {
                $this->entities[$entity->id] = new EntityDTO($entity);
            }

            ksort($this->entities);
        }
    }
}
