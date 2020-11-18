<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\TabDTO;
use function implode;

class TabModule extends BaseModule
{
    protected $baseRoute = 'tabs';

    public function getByProductIds(array $ids, string $relations = 'parameters'): array
    {
        $id = '?productIds='.implode(',', $ids);

        if ( ! empty($relations)) {
            $id .= '&relations='.$relations;
        }

        $data = [];
        $tabs = parent::get($id);

        if ( ! empty($tabs)) {
            foreach ($tabs as $tab) {
                $data[$tab->productId][$tab->id] = new TabDTO($tab);
            }
        }

        return $data;
    }

}
