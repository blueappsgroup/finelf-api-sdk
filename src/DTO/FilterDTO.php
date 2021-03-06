<?php

namespace Finelf_Api_Sdk\DTO;

class FilterDTO extends BaseDTO {
	public $name;
	public $rangeType;
	public $type;
	public $prefix;
	public $suffix;
	public $slug;
	public $description;

	public function __construct( $jsonObject, $rangeType) {
		parent::__construct($jsonObject);

		$this->rangeType = $rangeType;
	}
	protected function parameter( $parameter ) {
		$this->name      = $parameter->name;
		$this->type      = $parameter->type;
		$this->prefix    = $parameter->prefix === null ? '' : $parameter->prefix;
		$this->suffix    = $parameter->suffix === null ? '' : $parameter->suffix;
		$this->slug      = $parameter->slug;
	}
}
